<div id="notification"
    class="fixed top-4 right-4 z-10 flex items-center justify-between bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded"
    role="alert">
    <span class="me-2">{{ session('error') }}</span>
    <button type="button" class="text-red-700 hover:text-red-500" onclick="closeNotification()">
        &times;
    </button>
</div>
