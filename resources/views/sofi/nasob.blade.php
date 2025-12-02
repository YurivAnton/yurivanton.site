<x-layout>
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/sofi.css?=2') }}">
    @endpush

    <div style="padding-top: 100px;">
        <main class="col-12 col-lg-8 p-3 mx-auto">
            <div class="trainer-page">
                <!-- Тут буде HTML тренажера -->
                
                <h1 class="title">🌸 Тренажер Множення 🌸</h1>

                <table id="tasks" class="task-table">
                    @for ($i = 2; $i <= 9; $i++)
                        <tr>
                            @for ($j = 1; $j <= 9; $j++)
                                <td>{{ $i }}*{{ $j }}</td>
                            @endfor
                        </tr>
                    @endfor
                </table>

                <div class="trainer-card">
                    <div class="trainer">
                        <input id="a" readonly>
                        <span>*</span>
                        <input id="b" readonly>
                        <span>=</span>
                        <input id="answer">
                    </div>

                    <button id="check" class="btn">Перевірити ✔</button>
                </div>
            </div>
        </main>
    </div>

    <script src="{{ asset('js/sofi.js?=5') }}"></script>
</x-layout>