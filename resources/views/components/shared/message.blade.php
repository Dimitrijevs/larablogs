<div id="notification"
    class="fixed top-4 right-4 z-10 flex items-center justify-between bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded"
    role="alert">
    <span class="me-2">{{ session('message') }}</span>
    <button type="button" class="text-green-700 hover:text-green-500" onclick="closeNotification()">
        &times;
    </button>
</div>
