# TODO: Fix Route Error for admin.bookings.all

## Completed Tasks

-   [x] Identified the route error: Route [admin.bookings.all] not defined
-   [x] Found that the correct route is admin.booking.index
-   [x] Updated resources/views/admin/tables/booking/chat.blade.php to use admin.booking.index instead of admin.bookings.all (2 occurrences)
-   [x] Fixed missing deleteMessage method in AdminBookingController (renamed from deleteChat)
-   [x] Fixed undefined variable $messages in BookingAuthController chat method
-   [x] Added missing chat.send route and sendChat method for user chat functionality
-   [x] Fixed undefined route 'dashboard' in user chat page back button
-   [x] Fixed undefined variable $messages in booking layout
-   [x] Fixed admin layout chat link missing user_id parameter

## Summary

The error was caused by using an undefined route name 'admin.bookings.all' in the chat.blade.php file. The correct route name is 'admin.booking.index' as defined in routes/web.php. All occurrences have been fixed. Also added the missing deleteMessage method to handle message deletion. Fixed the undefined $messages variable in the user chat page by updating BookingAuthController to fetch and pass messages data. Added the missing chat.send route and sendChat method to enable users to send messages to admin. Fixed the back button in user chat page to use 'booking.index' instead of undefined 'dashboard' route. Fixed undefined $messages variable in booking layout by adding null coalescing operator. Fixed admin layout chat menu link to point to booking index instead of requiring user_id parameter.
