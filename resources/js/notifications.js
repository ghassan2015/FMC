import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: true,
    authEndpoint: '/broadcasting/auth',

      auth: {
    headers: {
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
    },
  },

    // هذا endpoint
});

window.Echo.private(`doctor.3`)
    .listen("Illuminate\\Notifications\\Events\\BroadcastNotificationCreated", (e) => {
        console.log("🔔 إشعار:", e.message);
    });
