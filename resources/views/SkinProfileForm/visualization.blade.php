@extends('layouts.app')

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<style>
    /* Bottom Navbar Styles */
    .bottom-navbar {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        background-color:rgb(84, 63, 100);  /* Indigo color */
        padding: 10px 0;
        display: flex;
        justify-content: space-around;
        align-items: center;
        box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.2);
    }

    .bottom-navbar a {
        color: white;
        text-decoration: none;
        font-size: 16px;
        text-align: center;
    }

    .bottom-navbar a:hover {
        color: #FFD700; /* Gold color for hover */
    }

    .bottom-navbar i {
        font-size: 20px;
        display: block;
        margin-bottom: 5px;
    }

    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        background-color:#6a0dad; /* Purple background */
        color: white; /* White text for better contrast */
    }
    h1 {
        margin: 20px 0;
    }
    .date-picker {
        margin: 20px 0;
    }
    .table-container {
        width: 100%;
        max-width: 800px;
        background-color: rgba(230, 230, 250, 0.5);
        padding: 10px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    th, td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #4CAF50;
        color: white;
    }

    @media (max-width: 600px) {
        .table-container {
            width: 100%;
            padding: 5px;
        }
    }
</style>

<!DOCTYPE html>
<html>
<head>
    <title>Skin Profile Visualization</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Skin Profile Data Visualization</h1>
    <div class="date-picker">
        <label for="startDate">Start Date: </label>
        <input type="date" id="startDate" name="startDate">
        <label for="endDate">End Date: </label>
        <input type="date" id="endDate" name="endDate">
        <button id="fetchData">Fetch Data</button>
    </div>
    <div class="available-dates">
        <h2>Available Dates</h2>
        <ul>
            @foreach($availableDates as $date)
                <li>{{ $date }}</li>
            @endforeach
        </ul>
    </div>
    <div class="table-container">
        <table id="dataTable">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Acne</th>
                    <th>Fine Line</th>
                    <th>Dark Spots</th>
                    <th>Redness</th>
                    <th>Dryness</th>
                    <th>Oily</th>
                    <th>Pores Rate</th>
                    <th>Irritation</th>
                    <th>Firmness</th>
                    <th>Dark Circles</th>
                    <th>Total Score</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data will be populated here -->
            </tbody>
        </table>
    </div>

    <script>
     $('#fetchData').on('click', function() {
    var startDate = $('#startDate').val();
    var endDate = $('#endDate').val();

    if (!startDate || !endDate) {
        alert('Please select both start and end dates.');
        return;
    }

    console.log('Start Date:', startDate);
    console.log('End Date:', endDate);

    $.ajax({
        url: '{{ route("SkinProfileForm.fetchDataByDateRange") }}',
        method: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            startDate: startDate,
            endDate: endDate
        },
        success: function(response) {
            console.log(response); // Log the response to check the data

            if (response.length < 2) {
                alert('Please select a date range that includes at least two dates with data.');
                return;
            }

            var tableBody = $('#dataTable tbody');
            tableBody.empty(); // Clear existing data

            response.forEach(function(profile) {
                var row = `<tr>
                    <td>${new Date(profile.created_at).toLocaleDateString()}</td>
                    <td>${profile.Acne}</td>
                    <td>${profile.FineLine}</td>
                    <td>${profile.Darkspots}</td>
                    <td>${profile.Redness}</td>
                    <td>${profile.Dryness}</td>
                    <td>${profile.Oily}</td>
                    <td>${profile.PoresRate}</td>
                    <td>${profile.Irritation}</td>
                    <td>${profile.Firmness}</td>
                    <td>${profile.Darkcircles}</td>
                    <td>${profile.total_score}</td>
                </tr>`;
                tableBody.append(row);
            });
        },
        error: function(xhr, status, error) {
            console.error('Error fetching data:', error);
            alert('An error occurred while fetching data. Please try again.');
        }
    });
});
</script>
</body>
</html>

<!-- Bottom Navbar -->
<div class="bottom-navbar">
    <a href="#">
        <i class="fas fa-info-circle"></i>
        About us
    </a>
    <a href="{{ route('home') }}">
        <i class="fas fa-home"></i>
        Home
    </a>
    <a href="#">
        <i class="fas fa-lightbulb"></i>
        Tips
    </a>
</div>
@endsection