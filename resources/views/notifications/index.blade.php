<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('notifications.title') }}
            </h2>
        </div>
    </x-slot>
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-lg font-bold dark:text-gray-200 text-gray-800">{{ __('notifications.unread_ones') }} - <span id="notifications-count">{{count(array_filter($notifications->toArray(), function($item) {return !$item['read'];}))}}</span></h1>
            <div class="grid grid-cols-1 gap-5 mt-5">
                @foreach($notifications as $notification)
                    @switch($notification->notification_type)
                        @case('left_review')
                            <div class="flex items-center">
                                <div id="notification-{{$notification->id}}" class="notification-item w-full p-4 bg-white {{$notification->read ? 'dark:bg-gray-800' : 'dark:bg-gray-700'}} overflow-hidden shadow-sm sm:rounded-lg text-gray-200">
                                    <div class="flex flex-row justify-between items-center text-lg font-medium dark:text-gray-200 text-gray-700">
                                        <div class="font-bold dark:text-gray-200">
                                            <a href="{{route('users.show', ['id' => $notification->source->id])}}" class="text-blue-400">{{$notification->source->name}}</a>
                                                {{ __('notifications.left_review') }} -
                                            <a href="{{route('reviews.show', ['id' => $notification->subject->id])}}" class="text-blue-400">{{$notification->subject->title}}</a>
                                        </div>
                                        <div class="flex items-center">
                                            <span class="text-sm">{{$notification->created_at->format('d.m.y - H:i:s')}}</span>
                                            <span id="new-badge-{{$notification->id}}" class="{{$notification->read ? 'hidden' : ''}} text-white bg-blue-500 rounded-lg ml-4 px-2 text-sm">{{ __('notifications.new') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <button data-read="{{$notification->read}}" data-notification-id="{{$notification->id}}"
                                        id="read-btn-{{$notification->id}}"
                                        class="read-btn {{$notification->read ? 'bg-gray-600' : 'bg-gray-500'}} rounded-lg h-full p-4 text-sm ml-3 min-w-fit flex items-center">
                                        {{ __('notifications.mark') }} {{$notification->read ? __('notifications.unread') : __('notifications.read')}}
                                </button>
                            </div>
                            @break
                        @case('bookmark_article')
                            <div class="flex items-center">
                                <div id="notification-{{$notification->id}}" class="notification-item w-full p-4 bg-white {{$notification->read ? 'dark:bg-gray-800' : 'dark:bg-gray-700'}} overflow-hidden shadow-sm sm:rounded-lg text-gray-200">
                                    <div class="flex flex-row justify-between items-center text-lg font-medium dark:text-gray-200 text-gray-700">
                                        <div class="font-bold">
                                            <a href="{{route('users.show', ['id' => $notification->source->id])}}" class="text-blue-400">{{$notification->source->name}}</a>
                                                {{ __('notifications.bookmarked') }} -
                                            <a href="{{route('feed.show_article', ['id' => $notification->subject->id])}}" class="text-blue-400">{{$notification->subject->title}}</a>
                                        </div>
                                        <div class="flex items-center">
                                            <span class="text-sm">{{$notification->created_at->format('d.m.y - H:i:s')}}</span>
                                            <span id="new-badge-{{$notification->id}}" class="{{$notification->read ? 'hidden' : ''}} text-white bg-blue-500 rounded-lg ml-4 px-2 text-sm">{{ __('notifications.new') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <button data-read="{{$notification->read}}" data-notification-id="{{$notification->id}}"
                                        id="read-btn-{{$notification->id}}"
                                        class="read-btn {{$notification->read ? 'bg-gray-600' : 'bg-gray-500'}} rounded-lg h-full p-4 text-sm ml-3 min-w-fit flex items-center">
                                        {{ __('notifications.mark') }} {{$notification->read ? __('notifications.unread') : __('notifications.read')}}
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
                            notification.classList.add('dark:bg-gray-600');
                            notification.classList.remove('dark:bg-gray-500');
                            readBtn.classList.add('bg-gray-600');
                            readBtn.classList.remove('bg-gray-500');
                            newBadge.classList.add('hidden');
                            readBtn.textContent = 'Mark Unread';
                            notificationsCount.textContent = (parseInt(notificationsCount.textContent) - 1).toString();
                        } else {
                            notification.classList.add('dark:bg-gray-600');
                            notification.classList.remove('dark:bg-gray-500');
                            readBtn.classList.add('bg-gray-500');
                            readBtn.classList.remove('bg-gray-600');
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
