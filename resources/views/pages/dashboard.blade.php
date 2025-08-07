@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')
    <div class="row g-3">
        @php
            $cards = [
                ['label' => 'Buku', 'count' => $countBuku, 'icon' => 'fa-book', 'color' => 'linear-gradient(135deg, #667eea, #764ba2)'],
                ['label' => 'Kategori', 'count' => $countJenisBuku, 'icon' => 'fa-tags', 'color' => 'linear-gradient(135deg, #43cea2, #185a9d)'],
                ['label' => 'Anggota', 'count' => $countAnggota, 'icon' => 'fa-users', 'color' => 'linear-gradient(135deg, #f7971e, #ffd200)'],
                ['label' => 'Peminjam', 'count' => $countPeminjamanBuku, 'icon' => 'fa-hand-holding', 'color' => 'linear-gradient(135deg, #e53935, #e35d5b)'],
            ];
        @endphp

        @foreach($cards as $card)
            <div class="col-12 col-sm-6 col-md-3">
                <div class="glass-card" style="--card-bg: {{ $card['color'] }}">
                    <div class="icon-box">
                        <i class="fas {{ $card['icon'] }}"></i>
                    </div>
                    <div class="details-box">
                        <div class="count" data-count="{{ $card['count'] }}">0</div>
                        <div class="label">{{ $card['label'] }}</div>
                    </div>
                    <a href="#" class="view-more">Lihat Detail <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@push('before-style')
    <style>
        .glass-card {
            background: var(--card-bg);
            border-radius: 16px;
            padding: 20px;
            color: #fff;
            box-shadow: 0 6px 20px rgba(0,0,0,0.15);
            backdrop-filter: blur(4px);
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
            min-height: 160px;
        }

        .glass-card:hover {
            transform: translateY(-5px) scale(1.01);
        }

        .icon-box {
            font-size: 30px;
            background: rgba(255, 255, 255, 0.15);
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 15px;
        }

        .icon-box i {
            animation: pulse 2s infinite;
        }

        .details-box .count {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .details-box .label {
            font-size: 15px;
            opacity: 0.9;
        }

        .view-more {
            font-size: 13px;
            color: rgba(255,255,255,0.9);
            text-decoration: none;
            position: absolute;
            bottom: 15px;
            right: 20px;
        }

        .view-more:hover {
            text-decoration: underline;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.15); }
            100% { transform: scale(1); }
        }

        /* Responsive optimization */
        @media (max-width: 576px) {
            .glass-card {
                padding: 15px;
                min-height: 130px;
            }
            .details-box .count {
                font-size: 22px;
            }
        }
    </style>
@endpush

@push('after-script')
    <script>
        // Animasi Count Up
        document.addEventListener("DOMContentLoaded", () => {
            const counters = document.querySelectorAll(".count");
            counters.forEach(counter => {
                const updateCount = () => {
                    const target = +counter.getAttribute("data-count");
                    const count = +counter.innerText;
                    const speed = 10; // Kecepatan naik angka

                    const increment = Math.ceil(target / 40);

                    if (count < target) {
                        counter.innerText = count + increment;
                        setTimeout(updateCount, speed);
                    } else {
                        counter.innerText = target;
                    }
                };
                updateCount();
            });
        });
    </script>
@endpush
