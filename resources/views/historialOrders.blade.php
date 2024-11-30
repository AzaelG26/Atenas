@extends('layout.sidebar')    
@section('title', 'Historial de ventas')
<script src="/docs/5.3/assets/js/color-modes.js"></script>

@push('styles')
    <style>
    .title-orders{
        border-bottom: 1px solid #ce9d22;
        
    }
    .subtitle-orders{
        color: white;
    }
    .subtitle-orders:hover{
        color: #ce9d22;
        filter: drop-shadow(0px 0px 5px #ce9d22);
    }
    </style>
@endpush

@section('content')
    <main id="content-all">
        <div class="container py-4">

            <div class="pb-3 mb-4 title-orders" style="display: flex; justify-content:space-between;">
                <span class="fs-4 subtitle-orders"> &nbsp; &nbsp;<i class="bi bi-clock-history"></i> Historial de ventas</span>      
            </div>
        </div>
    </main>
@endsection