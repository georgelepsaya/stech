<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Notifications') }}
            </h2>
        </div>
    </x-slot>
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-lg font-bold">Unread notifications - <span id="notifications-count">{{count(array_filter($notifications->toArray(), function($item) {return !$item['read'];}))}}</span></h1>
            <div class="grid grid-cols-1 gap-5 mt-5">
                @foreach($notifications as $notification)
                    @switch($notification->notification_type)
                        @case('left_review')
                            <div class="flex items-center">
                                <div id="notification-{{$notification->id}}" class="notification-item w-full p-4 bg-white {{$notification->read ? 'dark:bg-gray-800' : 'dark:bg-gray-700'}} overflow-hidden shadow-sm sm:rounded-lg text-gray-200">
                                    <h4 class="flex flex-row justify-between items-center text-lg font-medium">
                                        <span href="{{ route('notifications.show', ['id' => $notification->id]) }}" class="font-bold">
                                            <a href="{{route('users.show', ['id' => $notification->source->id])}}" class="text-blue-400">{{$notification->source->name}}</a>
                                                left review on your article -
                                            <a href="{{route('reviews.show', ['id' => $notification->subject->id])}}" class="text-blue-400">{{$notification->subject->title}}</a>
                                        </span>
                                        <div class="flex items-center">
                                            <span class="text-sm">{{$notification->created_at->format('d.m.y - H:i:s')}}</span>
                                            <span id="new-badge-{{$notification->id}}" class="{{$notification->read ? 'hidden' : ''}} bg-blue-500 rounded-lg ml-4 px-2 text-sm">New</span>
                                        </div>
                                    </h4>
                                </div>
                                <button data-read="{{$notification->read}}" data-notification-id="{{$notification->id}}"
                                        id="read-btn-{{$notification->id}}"
                                        class="read-btn {{$notification->read ? 'bg-gray-800' : 'bg-gray-700'}} rounded-lg h-full p-4 text-sm ml-3 min-w-fit flex items-center">
                                    Mark {{$notification->read ? 'Unread' : 'Read'}}
                                </button>
                            </div>
                            @break
                        @default
                            <p>Unrecognised notification</p>
                    @endswitch
                @endforeach
            </div>
        </div>
    </div>

    <script>
        const notificationsCount = document.getElementById('notifications-count');
        document.querySelectorAll('.read-btn').forEach(function(btn) {
            btn.addEventListener('click', function(event) {
                const currTarget = event.currentTarget;
                const notificationId = currTarget.getAttribute('data-notification-id');
                fetch(`notifications/${notificationId}/read`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                }).then(function(response) {
                    return response.json();  // parse the JSON response
                }).then(function(data) {
                    if (data.status === 'success') {
                        const notification = document.getElementById(`notification-${notificationId}`);
                        const readBtn = document.getElementById(`read-btn-${notificationId}`);
                        const newBadge = document.getElementById(`new-badge-${notificationId}`);
                        const isRead = btn.getAttribute('data-read') === 'true';
                        currTarget.setAttribute('data-read', (!isRead).toString());
                        if (data.read) {
                            notification.classList.add('dark:bg-gray-800');
                            notification.classList.remove('dark:bg-gray-700');
                            readBtn.classList.add('bg-gray-800');
                            readBtn.classList.remove('bg-gray-700');
                            newBadge.classList.add('hidden');
                            readBtn.textContent = 'Mark Unread';
                            notificationsCount.textContent = (parseInt(notificationsCount.textContent) - 1).toString();
                        } else {
                            notification.classList.add('dark:bg-gray-700');
                            notification.classList.remove('dark:bg-gray-800');
                            readBtn.classList.add('bg-gray-700');
                            readBtn.classList.remove('bg-gray-800');
                            newBadge.classList.remove('hidden');
                            readBtn.textContent = 'Mark Read';
                            notificationsCount.textContent = (parseInt(notificationsCount.textContent) + 1).toString();
                        }
                    } else {
                        console.log('ERROR');
                    }
                });
            });
        })
    </script>
</x-app-layout>
