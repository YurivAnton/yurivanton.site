<x-layout>
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/timesTable.css?=4') }}">
    @endpush

    <div class="trainer-wrapper">
        
        <!-- Бокова панель -->
        <aside class="sidebar">
            <div class="sidebar-user">
                @auth
                    <div class="avatar"><img src="{{ asset('img/ava_Sofi.jpg') }}"></div>
                    <div class="username">
                        Привіт,<br>
                        <strong>{{ auth()->user()->name }}</strong>
                    </div>
                @endauth
            </div>

            <ul class="menu">
                <li id="timesTable">📘 Таблиця множення</li>
                <li id="divisionTable">📘 Таблиця ділення</li>
                <li>⭐ Мої бали</li>
                <li>🏆 Досягнення</li>
            </ul>
        </aside>

        <!-- Основний контент -->
        <main class="content">
            <div class="trainer-page">

                <h1 class="title">💖 Тренажер Множення 💖</h1>

                <table id="tasks" class="task-table">
                    @for ($i = 2; $i <= 9; $i++)
                        <tr>
                            @for ($j = 2; $j <= 9; $j++)
                                <td>{{ $i }}*{{ $j }}</td>
                            @endfor
                        </tr>
                    @endfor
                </table>

                <div class="message" id="message">
                    <span class="message-text"></span>
                </div>

                <div class="trainer-card">
                    <div class="trainer">
                        <input id="a" readonly>
                        <span>*</span>
                        <input id="b" readonly>
                        <span>=</span>
                        <input id="answer" type="text" inputmode="numeric" autocomplete="off">
                    </div>

                    <button id="check" class="btn">Перевірити ✔</button>
                </div>

            </div>
        </main>
    </div>

    <script src="{{ asset('js/timesTable.js?=5') }}"></script>
    <script src="{{ asset('js/math.js?=1') }}"></script>
</x-layout>