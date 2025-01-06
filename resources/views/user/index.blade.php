<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survey App</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/css/app.css')

</head>

<body class="bg-gray-900 text-white">
    <main class="flex flex-col items-center justify-center min-h-screen px-4">
        <!-- Header -->
        <header class="text-center mb-6">
            <h1 class="text-2xl font-bold">{{ 'Survey Kepuasan Layanan Publik' }}</h1>
            <p class="text-gray-400">{{ 'Kami ingin mengetahui pendapat Anda tentang layanan kami.' }}</p>
        </header>

        <!-- Question Form -->
        <form id="survey-form" data-action="{{ route('fill_survey.submit') }}"
            class="w-full max-w-lg bg-gray-800 p-4 rounded-lg shadow-md" method="POST" action="/survey/submit">
            @csrf
            <div id="question-container">
                <div class="question">
                    <div class="my-5">
                        <label for="name_user" class="block text-white font-medium mb-2">
                            Masukan Nama Anda <span class="text-red-600">*</span>
                        </label>
                        <input type="text" id="name_user" name="name_user"
                            class="w-full px-4 py-2 bg-gray-900 text-white border border-gray-600 rounded focus:outline-none focus:ring focus:ring-blue-500"
                            placeholder="Masukkan nama Anda" required />
                    </div>
                    <div class="my-5">
                        <label for="survey-select" class="block text-white font-medium mb-2">
                            Pilih layanan <span class="text-red-600">*</span>
                        </label>
                        <select id="survey-select" name="survey_id"
                            class="w-full px-4 py-2 bg-gray-900 text-white border border-gray-600 rounded focus:outline-none focus:ring focus:ring-blue-500"
                            required>
                            <option selected disabled>Pilih Layanan</option>
                            @foreach ($survey as $index => $item)
                                <option value="{{ $item->id }}">
                                    {{ $item->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Container for Questions --}}
                    <div id="questions-container" class="my-5 hidden">
                        <h2 class="text-white font-medium mb-4">Pertanyaan</h2>
                        <div id="questions-list" class="space-y-6"></div>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div id="submit-container" class="mt-6">
                <button type="submit"
                    class="w-full bg-green-700 text-white px-4 py-2 rounded hover:bg-green-600 flex items-center justify-center">
                    Submit
                </button>
            </div>
        </form>

    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.getElementById('survey-select').addEventListener('change', function() {
            const surveyId = this.value || 1;
            const questionsContainer = document.getElementById('questions-container');
            const questionsList = document.getElementById('questions-list');

            // Reset previous questions
            questionsList.innerHTML = '';
            questionsContainer.classList.add('hidden');

            if (surveyId) {
                // Fetch questions using AJAX
                fetch(`/survey/questions/${surveyId}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.length > 0) {
                            questionsContainer.classList.remove('hidden');

                            // Populate questions
                            data.forEach(question => {
                                const questionDiv = document.createElement('div');
                                questionDiv.classList.add('my-5');

                                questionDiv.innerHTML = `
                            <label for="" class="block text-white font-medium mb-2">
                                ${question.question} <span class="text-red-600">*</span>
                            </label>
                            <div class="flex space-x-4">
                                ${['Sangat Tidak Setuju', 'Tidak Setuju', 'Cukup', 'Puas', 'Sangat Puas'].map(option => `
                                                    <label
                                                        class="flex flex-col items-center p-4 bg-gray-900 border border-gray-700 rounded-lg hover:bg-gray-800 cursor-pointer">
                                                        <input type="radio" name="question_${question.id}" value="${option}"
                                                            class="hidden form-radio text-blue-500 bg-gray-900 focus:ring-blue-500"
                                                            required ${question.id === 1 && option === 'Cukup' ? 'checked' : ''}>
                                                        <span class="text-3xl">
                                                            ${getEmoji(option)}
                                                        </span>
                                                        <span class="mt-2 text-white">${option}</span>
                                                    </label>
                                                `).join('')}
                            </div>
                        `;
                                questionsList.appendChild(questionDiv);
                            });
                        }
                    })
                    .catch(error => console.error('Error fetching questions:', error));
            }
        });

        function getEmoji(option) {
            switch (option) {
                case 'Sangat Tidak Setuju':
                    return '😠';
                case 'Tidak Setuju':
                    return '😐';
                case 'Cukup':
                    return '🙂';
                case 'Puas':
                    return '😁';
                case 'Sangat Puas':
                    return '🤩';
                default:
                    return '';
            }
        }

        document.addEventListener('click', function(e) {
            if (e.target.type === 'radio') {
                // Cari semua radio buttons dalam grup yang sama
                const name = e.target.name;
                const radios = document.querySelectorAll(`input[name="${name}"]`);

                // Reset semua label radio buttons
                radios.forEach(radio => {
                    const parentLabel = radio.closest('label');
                    parentLabel.classList.remove('bg-green-600');
                    parentLabel.classList.add('bg-gray-900');
                });

                // Tambahkan warna hijau pada radio yang dipilih
                const selectedLabel = e.target.closest('label');
                selectedLabel.classList.remove('bg-gray-900');
                selectedLabel.classList.add('bg-green-600');
            }
        });

        document.getElementById('survey-form').addEventListener('submit', function(e) {
            e.preventDefault(); // Menghindari pengiriman form default

            // Mengambil data dari form
            const surveyId = document.getElementById('survey-select').value;
            const nameUser = document.getElementById('name_user').value;
            const answers = {};
            const url = document.getElementById('survey-form').getAttribute('data-action');

            // Ambil semua jawaban dari form
            const radioButtons = document.querySelectorAll('input[type="radio"]:checked');
            radioButtons.forEach(function(radio) {
                const questionId = radio.name.replace('question_', ''); // Ambil ID pertanyaan dari name
                answers[questionId] = radio.value; // Menyimpan jawaban dengan questionId sebagai kunci
            });

            // Menyusun data untuk dikirim
            const data = {
                survey_id: surveyId, // ID survey yang dipilih
                name_user: nameUser, // Nama pengguna
                answers: answers // Jawaban yang dikumpulkan
            };

            // Mengambil CSRF token dari meta tag
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Mengirim data menggunakan AJAX
            $.ajax({
                type: "POST", // Menggunakan metode POST
                url: url, // URL untuk pengiriman data
                data: JSON.stringify(data), // Mengirim data dalam format JSON
                contentType: "application/json", // Memberi tahu server bahwa data yang dikirim adalah JSON
                dataType: "json", // Format data yang diharapkan dalam respons
                headers: {
                    'X-CSRF-TOKEN': csrfToken // Menambahkan CSRF token ke header
                },
                success: function(response) {
                    // Tanggapan sukses dari server
                    alert('Survey submitted successfully!');
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    // Jika ada error saat pengiriman
                    alert('Error submitting survey: ' + error);
                    console.error(xhr, status, error);
                }
            });
        });
    </script>
</body>

</html>
