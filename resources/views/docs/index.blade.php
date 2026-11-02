
@extends('layout.app') {{-- Atau templat utama anda --}}

@section('title', 'Dokumentasi Sistem')

@section('content')
    {{-- Masukkan keseluruhan struktur HTML yang anda berikan di sini --}}
    {{-- Pastikan untuk menggantikan bahagian gelung @foreach dan paparan dokumentasi --}}

    <!-- ... (bahagian atas HTML anda: header, search, stats) ... -->

            <div id="docsContainer">
                @forelse ($docs as $doc)
                    <div class="doc-section" data-search="{{ strtolower($doc->class_name . ' ' . $doc->documentation) }}">
                        <div class="doc-header" onclick="toggleDoc(this)">
                            <div class="doc-title">
                                <span class="doc-badge">
                                    {{-- Logik untuk badge berdasarkan nama kelas --}}
                                    @if (Str::contains(strtolower($doc->class_name), 'controller'))
                                        CONTROLLER
                                    @elseif (Str::contains(strtolower($doc->class_name), 'service'))
                                        SERVICE
                                    @elseif (Str::contains(strtolower($doc->class_name), 'model'))
                                        MODEL
                                    @else
                                        CLASS
                                    @endif
                                </span>
                                {{ $doc->class_name }}
                            </div>
                            <span class="collapse-icon">▼</span>
                        </div>
                        <div class="doc-content">
                            <div class="doc-body">
                                <div class="doc-meta">
                                    <div class="meta-title">📋 Maklumat Kelas</div>
                                    <div class="meta-content">
                                        <strong>Nama Kelas:</strong> {{ $doc->class_name }}<br>
                                        <strong>Laluan Sumber:</strong> {{ $doc->source_path }}<br>
                                        <strong>Dijana pada:</strong> {{ $doc->updated_at ? $doc->updated_at->format('d M Y, H:i') : 'N/A' }}
                                    </div>
                                </div>

                                {{-- Paparkan HTML yang telah ditukar dari Markdown --}}
                                {!! $doc->documentation_html !!}
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="no-results">
                        <h3>🚫 Tiada dokumentasi dijumpai</h3>
                        <p>Sila jalankan perintah <code class="command">php artisan generate:docs</code> untuk menjana dokumentasi.</p>
                    </div>
                @endforelse
            </div>

            <div id="noResults" class="no-results" style="display: none;">
                <h3>🔍 Tiada hasil carian dijumpai</h3>
                <p>Cuba cari dengan kata kunci yang berbeza.</p>
            </div>
        {{-- ... (bahagian bawah HTML anda: skrip JavaScript) ... --}}
    <script>
        // Skrip JavaScript sedia ada anda untuk toggle dan carian
        function toggleDoc(header) {
            const content = header.nextElementSibling;
            const icon = header.querySelector('.collapse-icon');
            const isActive = content.classList.contains('active');

            document.querySelectorAll('.doc-content.active').forEach(el => {
                if (el !== content) {
                    el.classList.remove('active');
                    el.previousElementSibling.classList.remove('active');
                    el.previousElementSibling.querySelector('.collapse-icon').classList.remove('active');
                }
            });

            content.classList.toggle('active');
            header.classList.toggle('active');
            icon.classList.toggle('active');
        }

        document.getElementById('searchBox').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const docSections = document.querySelectorAll('.doc-section');
            const noResults = document.getElementById('noResults');
            const docsContainer = document.getElementById('docsContainer');
            let hasResults = false;

            docSections.forEach(section => {
                const searchData = section.getAttribute('data-search'); // Pastikan data-search ada kandungan yang relevan
                
                if (searchData.includes(searchTerm) || searchTerm === '') {
                    section.style.display = 'block';
                    hasResults = true;
                } else {
                    section.style.display = 'none';
                }
            });

            if (document.querySelector('.no-results h3').textContent.startsWith('🚫')) {
                 // Jika tiada dokumen langsung, jangan tunjukkan "no search results"
            } else {
                docsContainer.style.display = hasResults ? 'block' : 'none';
                noResults.style.display = hasResults ? 'none' : 'block';
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            // Kosongkan semua status aktif dahulu
            document.querySelectorAll('.doc-content').forEach(el => el.classList.remove('active'));
            document.querySelectorAll('.doc-header').forEach(el => el.classList.remove('active'));
            document.querySelectorAll('.collapse-icon').forEach(el => el.classList.remove('active'));

            // Aktifkan bahagian dokumentasi yang pertama jika ada
            const firstDocHeader = document.querySelector('.doc-header');
            if (firstDocHeader) {
                firstDocHeader.classList.add('active');
                firstDocHeader.nextElementSibling.classList.add('active');
                firstDocHeader.querySelector('.collapse-icon').classList.add('active');
            }
        });
    </script>
@endsection