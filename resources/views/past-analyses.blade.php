@extends('layouts.app')

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<style>
    body, .container {
        background-color: #6a0dad;
        font-family: Arial, sans-serif;
        color: #fff;
    }

    .container {
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        max-width: 100%;
        margin: auto;
        padding-bottom: 120px;
    }

    .btn, .form-control {
        border-radius: 10px;
        border: none;
        color: #fff;
        background-color: #6a0dad;
    }

    .btn:hover {
        background-color: #5d3fd3;
    }

    .form-control {
        margin-bottom: 15px;
        background-color: #8a2be2;
    }

    h1 {
        text-align: center;
        margin-bottom: 30px;
    }

    .face-result {
        background-color: #fff;
        border-radius: 10px;
        padding: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
        color: #000;
    }

    .face-result h2 {
        text-align: center;
        margin-bottom: 15px;
    }

    .face-result p {
        margin-bottom: 8px;
    }

    .face-result img {
        display: block;
        margin: 0 auto 15px;
        max-width: 100%;
        border-radius: 10px;
    }

    .pagination {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }

    input[type="date"] {
        position: relative;
        padding: 10px;
        border-radius: 10px;
        border: 1px solid rgb(148, 64, 64);
        background-color: rgb(156, 110, 189);
        color: #fff;
    }

    input[type="date"]::-webkit-calendar-picker-indicator {
        filter: invert(1);
    }

    .button-group {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
    }

    @media (min-width: 576px) {
        .button-group {
            flex-direction: row;
        }
    }

    .bottom-navbar {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        background-color: rgb(84, 63, 100);
        display: flex;
        justify-content: space-around;
        align-items: center;
        padding: 10px 0;
        box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.2);
        z-index: 1000;
    }

    .bottom-navbar a {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        color: white;
        text-decoration: none;
        font-size: 14px;
        padding: 5px;
        transition: color 0.3s ease, transform 0.3s ease;
    }

    .bottom-navbar a:hover {
        color: #FFD700;
        transform: scale(1.1);
    }

    .bottom-navbar i {
        font-size: 20px;
        margin-bottom: 4px;
    }

    .bottom-navbar span {
        font-size: 12px;
    }

    .container {
        padding-bottom: 40px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 15px;
        font-size: 14px;
    }

    table, th, td {
        border: 1px solid #dcdcdc;
    }

    th, td {
        padding: 5px;
        text-align: left;
    }

    th {
        background-color: #4b0082;
        color: #fff;
    }

    /* New styles to make the table smaller */
    table {
        table-layout: fixed;
    }

    th, td {
        padding: 8px;
        font-size: 12px;
    }

    th {
        width: 50%;
    }

    td {
        word-wrap: break-word;
    }
</style>

@section('content')
<div class="container">
    <h1>Past Face Detection Analyses</h1>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Search Form -->
    <form method="GET" action="{{ route('past-analyses.index') }}" class="mb-4">
        <div class="input-group">
            <input type="date" name="date" class="form-control" value="{{ request('date') }}">
            <div class="input-group-append">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </div>
    </form>

    @if(isset($pastAnalyses) && count($pastAnalyses) > 0)
        @foreach($pastAnalyses as $pastAnalysis)
            <div class="face-result">
                <h2>Past Analysis</h2>
                <section>
                    <p><strong>Date:</strong> {{ $pastAnalysis->created_at->format('d M Y') }}</p>
                </section>
                <table>
                    <thead>
                        <tr>
                            <th>Attribute</th>
                            <th>Value</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pastAnalysis->analysis as $key => $value)
                            <tr>
                                <td>{{ ucfirst(str_replace('_', ' ', $key)) }}</td>
                                <td>
                                    @if(is_array($value))
                                        {{ implode(', ', $value) }}
                                    @else
                                        {{ $value }}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <form action="{{ route('past-analyses.destroy', $pastAnalysis->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        @endforeach
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end">
                @if ($pastAnalyses->onFirstPage())
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $pastAnalyses->previousPageUrl() }}" tabindex="-1" aria-disabled="true">Previous</a>
                    </li>
                @endif

                @for ($i = 1; $i <= $pastAnalyses->lastPage(); $i++)
                    <li class="page-item {{ $i == $pastAnalyses->currentPage() ? 'active' : '' }}">
                        <a class="page-link" href="{{ $pastAnalyses->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor

                @if ($pastAnalyses->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $pastAnalyses->nextPageUrl() }}">Next</a>
                    </li>
                @else
                    <li class="page-item disabled">
                        <a class="page-link" href="#">Next</a>
                    </li>
                @endif
            </ul>
        </nav>
    @else
        <p>No past analyses found.</p>
        <a href="{{ route('past-analyses.index') }}" class="btn btn-primary">Back </a>
    @endif
</div>

<!-- Bottom Navbar -->
<div class="bottom-navbar">
    <a href="{{ route('Aboutus.index') }}">
        <i class="fas fa-info-circle"></i>
        <span>About Us</span>
    </a>
    <a href="{{ route('home') }}">
        <i class="fas fa-home"></i>
        <span>Home</span>
    </a>
    <a href="{{ route('Tips.index') }}">
        <i class="fas fa-lightbulb"></i>
        <span>Tips</span>
    </a>
</div>
@endsection