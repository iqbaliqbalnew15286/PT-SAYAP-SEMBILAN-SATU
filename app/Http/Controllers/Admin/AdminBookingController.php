<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminBookingController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with([
            'user' => function ($q) {
                $q->withCount([
                    'messagesAsSender as unread_messages_count' => function ($query) {
                        $query->where('receiver_id', Auth::id())->where('is_read', false);
                    }
                ]);
            }
        ])->latest()->paginate(10);

        return view('admin.tables.booking.index', compact('reservations'));
    }

    public function chat($user_id)
    {
        $user = User::findOrFail($user_id);

        // Ambil percakapan antara Admin yang sedang login dan User tertentu
        $messages = Message::where(function ($q) use ($user) {
            $q->where('sender_id', Auth::id())->where('receiver_id', $user->id);
        })->orWhere(function ($q) use ($user) {
            $q->where('sender_id', $user->id)->where('receiver_id', Auth::id());
        })->orderBy('created_at', 'asc')->get();

        // Tandai pesan dari user ini sebagai 'sudah dibaca' oleh admin
        Message::where('sender_id', $user->id)
            ->where('receiver_id', Auth::id())
            ->where('is_read', false)
            ->update(['is_read' => true]);

        // Sidebar: Ambil semua user yang pernah berinteraksi
        $active_chats = User::where('id', '!=', Auth::id())
            ->where(function ($query) {
                $query->whereHas('reservations')
                    ->orWhereHas('messagesAsSender')
                    ->orWhereHas('messagesAsReceiver');
            })
            ->get()
            ->map(function ($u) {
                // Mengambil pesan terakhir untuk preview di sidebar
                $lastMsg = Message::where(function ($q) use ($u) {
                    $q->where('sender_id', Auth::id())->where('receiver_id', $u->id);
                })->orWhere(function ($q) use ($u) {
                    $q->where('sender_id', $u->id)->where('receiver_id', Auth::id());
                })->latest()->first();

                $u->last_interaction = $lastMsg ? $lastMsg->created_at : $u->created_at;
                $u->latest_msg_text = $lastMsg ? $lastMsg->message : 'Belum ada pesan';
                $u->latest_msg_image = $lastMsg ? $lastMsg->image : null;
                $u->unread_count = Message::where('sender_id', $u->id)
                    ->where('receiver_id', Auth::id())
                    ->where('is_read', false)->count();
                return $u;
            })->sortByDesc('last_interaction');

        return view('admin.tables.booking.chat', compact('user', 'messages', 'active_chats'));
    }

    public function sendChat(Request $request)
    {
        $request->validate([
            'message' => 'required_without:image|nullable|string',
            'receiver_id' => 'required|exists:users,id',
            'image' => 'nullable|image|max:5120'
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('chat_images', 'public');
        }

        // Simpan pesan dengan sender_type 'admin'
        Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message ?? '',
            'sender_type' => 'admin', // Ini krusial agar di view public bisa dideteksi sebagai pesan admin
            'image' => $imagePath,
            'is_read' => false,
        ]);

        return back();
    }

    public function deleteMessage($id)
    {
        $message = Message::where('id', $id)->where('sender_id', Auth::id())->firstOrFail();

        if ($message->image) {
            Storage::disk('public')->delete($message->image);
        }

        $message->delete();
        return back()->with('success', 'Pesan dihapus.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,process,success',
            'payment_status' => 'nullable|in:paid,unpaid'
        ]);

        $reservation = Reservation::findOrFail($id);
        $reservation->update([
            'status' => $request->status,
            'payment_status' => $request->payment_status ?? $reservation->payment_status
        ]);

        return back()->with('success', 'Status booking berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();

        return back()->with('success', 'Booking berhasil dihapus.');
    }
}
