<x-app-layout>
    @if(session()->has('success'))
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
            <span class="font-medium">Пароль успешно изменен!</span>
        </div>
    @endif

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Управление аккаунтом') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div>
                        <div class="px-4 sm:px-0">
                            <h3 class="text-base font-semibold leading-7 text-gray-900">Информация о аккаунте</h3>
                            <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-500">Здесь вы можете изменить необходимые данные</p>
                        </div>
                        <div class="mt-6 border-t border-gray-100">
                            <dl class="divide-y divide-gray-100">
                                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                    <dt class="text-sm font-medium leading-6 text-gray-900">Логин</dt>
                                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ Auth::user()->name }}</dd>
                                </div>
                                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                    <dt class="text-sm font-medium leading-6 text-gray-900">Почта</dt>
                                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ Auth::user()->email }}</dd>
                                </div>
                                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                    <dt class="text-sm font-medium leading-6 text-gray-900">Telegram</dt>
                                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                                        @if(Auth::user()->telegram)
                                            {{ Auth::user()->telegram }}
                                        @else
                                            <p class="text-red-500">Не указан</p>
                                        @endif
                                    </dd>
                                </div>
                                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                    <dt class="text-sm font-medium leading-6 text-gray-900">Номер телефона</dt>
                                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ Auth::user()->tel }}</dd>
                                </div>
                                <x-primary-button data-modal-target="choose-type-modal" data-modal-toggle="choose-type-modal" >{{ __('Изменить пароль') }}</x-primary-button>
                            </dl>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Main modal -->
    <div id="choose-type-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Изменение пароля
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5 space-y-4">
                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                        Необходимо выбрать один из доступных способов подтверждения личности
                    </p>
                </div>
                <!-- Modal footer -->
                <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                    @if(Auth::user()->telegram)
                        <form id="telegram-form" action="{{ route('change-password-telegram') }}" method="POST">
                            @csrf
                            <x-primary-button data-modal-target="type-telegram" data-modal-toggle="type-telegram" >{{ __('Telegram') }}</x-primary-button>
                        </form>
                    @endif
                    <div class="m-4">
                        <form id="email-form" action="{{ route('change-password-email') }}" method="POST">
                            @csrf
                            <x-primary-button data-modal-target="type-email" data-modal-toggle="type-email" >{{ __('Почта') }}</x-primary-button>
                        </form>
                    </div>
                    <form id="telephone-form" action="{{ route('change-password-tel') }}" method="POST">
                        @csrf
                        <x-primary-button data-modal-target="type-telephone" data-modal-toggle="type-telephone" >{{ __('Телефон') }}</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Email -->
    <div id="type-email" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Код отправлен!
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5 space-y-4">
                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                        Наш бот отправил код восстановления пароля на вашу почту ({{ Auth::user()->email }})
                    </p>

                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                        Обычно, код приходит в течение 5 минут. Если этого не произошло - попробуйте повторить позже.
                    </p>
                </div>
                <!-- Modal footer -->
                <div class="p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <form id="check-code-email" action="{{route('change-password-email-submit')}}" action="POST">
                        @csrf

                        <div class="m-4">
                            <x-input-label for="code" :value="__('Код')" />
                            <x-text-input id="code" class="block mt-1 w-full" type="text" name="code" :value="old('code')" required autofocus autocomplete="code" />
                            <x-input-error :messages="$errors->get('code')" class="mt-2" />
                        </div>

                        <div id="code-container-email"></div>
                        <p id="fail_check_block_email" class="text-red-600 hidden">Код неверный/истек</p>

                        <x-primary-button class="ms-4">
                            {{ __('Подтвердить') }}
                        </x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>

        <!-- Tel -->
        <div id="type-telephone" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Код отправлен!
                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 md:p-5 space-y-4">
                        <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                            Наш бот отправил код восстановления пароля на ваш номер телефона ({{ Auth::user()->tel }})
                        </p>

                        <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                            Обычно, код приходит в течение 5 минут. Если этого не произошло - попробуйте повторить позже.
                        </p>
                    </div>
                    <!-- Modal footer -->
                    <div class="p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <form id="check-code-telephone" action="{{route('change-password-tel-submit')}}" action="POST">
                            @csrf

                            <div class="m-4">
                                <x-input-label for="code" :value="__('Код')" />
                                <x-text-input id="code" class="block mt-1 w-full" type="text" name="code" :value="old('code')" required autofocus autocomplete="code" />
                                <x-input-error :messages="$errors->get('code')" class="mt-2" />
                            </div>

                            <div id="code-container-tel"></div>
                            <p id="fail_check_block_tel" class="text-red-600 hidden">Код неверный/истек</p>

                            <x-primary-button class="ms-4">
                                {{ __('Подтвердить') }}
                            </x-primary-button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Telegram -->
    <div id="type-telegram" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Код отправлен!
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5 space-y-4">
                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                        Наш бот отправил код восстановления пароля в ваш телеграм ({{ Auth::user()->telegram }})
                    </p>

                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                        Обычно, код приходит в течение 5 минут. Если этого не произошло - попробуйте повторить позже.
                    </p>
                </div>
                <!-- Modal footer -->
                <div class="p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <form id="check-code-telegram" action="{{route('change-password-telegram-submit')}}" action="POST">
                        @csrf

                        <div class="m-4">
                            <x-input-label for="code" :value="__('Код')" />
                            <x-text-input id="code" class="block mt-1 w-full" type="text" name="code" :value="old('code')" required autofocus autocomplete="code" />
                            <x-input-error :messages="$errors->get('code')" class="mt-2" />
                        </div>

                        <div id="code-container-tg"></div>
                        <p id="fail_check_block_tg" class="text-red-600 hidden">Код неверный/истек</p>

                        <x-primary-button class="ms-4">
                            {{ __('Подтвердить') }}
                        </x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Change password -->
    <div id="change-password" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Введите новый пароль снизу
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal footer -->
                <div class="p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <form id="check-code-email" action="{{route('change-password')}}" method="POST">
                        @csrf

                        <div class="m-4">
                            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autofocus autocomplete="code" />
                            <x-input-error :messages="$errors->get('code')" class="mt-2" />
                        </div>

                        <div id="code-container"></div>

                        <x-primary-button class="ms-4">
                            {{ __('Подтвердить') }}
                        </x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('telegram-form').addEventListener('submit', function(event) {
            event.preventDefault();

            const form = this;
            const formData = new FormData(form);

            fetch(form.action, {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    const codeValue = data.code;

                    document.getElementById('code-container-tg').textContent = codeValue;
                })
                .catch(error => {
                    console.error(error);
                });
        });

        document.getElementById('email-form').addEventListener('submit', function(event) {
            event.preventDefault();

            const form = this;
            const formData = new FormData(form);

            fetch(form.action, {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    const codeValue = data.code;

                    document.getElementById('code-container-email').textContent = codeValue;
                })
                .catch(error => {
                    console.error(error);
                });
        });

        document.getElementById('telephone-form').addEventListener('submit', function(event) {
            event.preventDefault();

            const form = this;
            const formData = new FormData(form);

            fetch(form.action, {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    const codeValue = data.code;

                    document.getElementById('code-container-tel').textContent = codeValue;
                })
                .catch(error => {
                    console.error(error);
                });
        });

        document.getElementById('check-code-telegram').addEventListener('submit', function(event) {
            event.preventDefault();

            const form = this;
            const formData = new FormData(form);

            fetch(form.action, {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if(data.exists == true)
                    {
                        document.getElementById('change-password').classList.remove('hidden');
                        document.getElementById('change-password').classList.add('flex');

                        document.getElementById('type-telegram').classList.add('hidden');
                        document.getElementById('type-telegram').classList.remove('flex');
                    } else {
                        document.getElementById('fail_check_block_tg').classList.remove('hidden');
                        document.getElementById('fail_check_block_tg').classList.add('block');
                    }
                })
                .catch(error => {
                    console.error(error);
                });
        });

        document.getElementById('check-code-email').addEventListener('submit', function(event) {
            event.preventDefault();

            const form = this;
            const formData = new FormData(form);

            fetch(form.action, {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if(data.exists == true)
                    {
                        document.getElementById('change-password').classList.remove('hidden');
                        document.getElementById('change-password').classList.add('flex');

                        document.getElementById('type-email').classList.add('hidden');
                        document.getElementById('type-email').classList.remove('flex');
                    } else {
                        document.getElementById('fail_check_block_email').classList.remove('hidden');
                        document.getElementById('fail_check_block_email').classList.add('block');
                    }
                })
                .catch(error => {
                    console.error(error);
                });
        });

        document.getElementById('check-code-telephone').addEventListener('submit', function(event) {
            event.preventDefault();

            const form = this;
            const formData = new FormData(form);

            fetch(form.action, {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if(data.exists == true)
                    {
                        document.getElementById('change-password').classList.remove('hidden');
                        document.getElementById('change-password').classList.add('flex');

                        document.getElementById('type-telephone').classList.add('hidden');
                        document.getElementById('type-telephone').classList.remove('flex');
                    } else {
                        document.getElementById('fail_check_block_tel').classList.remove('hidden');
                        document.getElementById('fail_check_block_tel').classList.add('block');
                    }
                })
                .catch(error => {
                    console.error(error);
                });
        });
    </script>
</x-app-layout>
