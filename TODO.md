# TODO: Fix Booking Route and Authentication

## Completed Tasks

-   [x] Identify the issue: Route was trying to return view('booking') but file is at 'pages.booking.booking'
-   [x] Change booking route to check authentication: if not logged in, show login page; if logged in, show booking page
-   [x] Add separate routes for booking/login, booking/register, booking/verify
-   [x] Fix view path to 'pages.booking.booking' for authenticated users

## Remaining Tasks

-   [x] Add missing POST routes for booking authentication (login.post, register.post, reset.post, logout)
-   [ ] Create or update login.blade.php with proper login form that redirects to booking after login
-   [ ] Test the authentication flow
-   [ ] Ensure login form posts to correct route and handles authentication
