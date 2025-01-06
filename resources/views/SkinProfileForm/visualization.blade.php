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
            background-color:rgb(84, 63, 100); /* Indigo color */
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
    </style>
<!DOCTYPE html>
<html>
<head>
    <title>Skin Profile Visualization</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #800080; /* Purple background */
            color: white; /* White text for better contrast */
        }
        h1 {
            margin: 20px 0;
        }
        .chart-container {
            width: 100%;
            max-width: 600px;
            background-color: rgba(230, 230, 250, 0.5);
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .date-picker {
            margin: 20px 0;
        }
        canvas {
            min-height: 400px; /* Set a minimum height for better readability */
        }
        .average-score {
            margin: 20px 0;
            font-size: 18px;
            font-weight: bold;
        }
        .home-button {
            margin: 20px 0;
            padding: 10px 20px;
            background-color: #4CAF50; /* Green background */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }
        .home-button:hover {
            background-color: #45a049; /* Darker green on hover */
        }
    </style>
</head>
<body>
    <h1>Skin Profile Data Visualization</h1>
    <div class="date-picker">
        <label for="date">Select Date: </label>
        <input type="date" id="date" name="date">
        <button id="fetchData">Fetch Data</button>
    </div>
    <div class="average-score" id="averageScore">Average Skin Health Condition: N/A</div>
    <div class="chart-container">
        <canvas id="skinProfileChart"></canvas>
    </div>
  
    <script>
        var ctx = document.getElementById('skinProfileChart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [],
                datasets: []
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            color: 'black', // Color of the legend text
                            font: {
                                size: 14,
                                weight: 'bold'
                            }
                        }
                    }
                }
            }
        });

        function calculateAverageSkinHealth(profiles) {
            let totalScore = 0;
            let count = profiles.length;

            profiles.forEach(profile => {
                totalScore += profile.Acne;
                totalScore += profile.FineLine;
                totalScore += profile.Darkspots;
                totalScore += profile.Redness;
                totalScore += profile.Dryness;
                totalScore += profile.Oily;
                totalScore += profile.PoresRate;
                totalScore += profile.Irritation;
                totalScore += profile.Firmness;
                totalScore += profile.Darkcircles;
            });

            let averageScore = totalScore / (count * 10); // Each profile has 10 attributes
            return averageScore;
        }

        $('#fetchData').on('click', function() {
            var selectedDate = $('#date').val();
            $.ajax({
                url: '{{ route("SkinProfileForm.fetchDataByDate") }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    date: selectedDate
                },
                success: function(response) {
                    var labels = response.map(function(profile) {
                        var date = new Date(profile.created_at);
                        return date.getDate() + '-' + (date.getMonth() + 1) + '-' + date.getFullYear();
                    });
                    var datasets = [
                        {
                            label: 'Acne',
                            data: response.map(function(profile) {
                                return profile.Acne;
                            }),
                            backgroundColor: 'rgba(255, 99, 132, 0.8)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'FineLine',
                            data: response.map(function(profile) {
                                return profile.FineLine;
                            }),
                            backgroundColor: 'rgba(54, 162, 235, 0.8)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Darkspots',
                            data: response.map(function(profile) {
                                return profile.Darkspots;
                            }),
                            backgroundColor: 'rgba(75, 192, 192, 0.8)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Redness',
                            data: response.map(function(profile) {
                                return profile.Redness;
                            }),
                            backgroundColor: 'rgba(153, 102, 255, 0.8)',
                            borderColor: 'rgba(153, 102, 255, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Dryness',
                            data: response.map(function(profile) {
                                return profile.Dryness;
                            }),
                            backgroundColor: 'rgba(255, 159, 64, 0.8)',
                            borderColor: 'rgba(255, 159, 64, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Oily',
                            data: response.map(function(profile) {
                                return profile.Oily;
                            }),
                            backgroundColor: 'rgba(255, 206, 86, 0.8)',
                            borderColor: 'rgba(255, 206, 86, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'PoresRate',
                            data: response.map(function(profile) {
                                return profile.PoresRate;
                            }),
                            backgroundColor: 'rgba(75, 192, 192, 0.8)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Irritation',
                            data: response.map(function(profile) {
                                return profile.Irritation;
                            }),
                            backgroundColor: 'rgba(153, 102, 255, 0.8)',
                            borderColor: 'rgba(153, 102, 255, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Firmness',
                            data: response.map(function(profile) {
                                return profile.Firmness;
                            }),
                            backgroundColor: 'rgba(255, 159, 64, 0.8)',
                            borderColor: 'rgba(255, 159, 64, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Darkcircles',
                            data: response.map(function(profile) {
                                return profile.Darkcircles;
                            }),
                            backgroundColor: 'rgba(255, 206, 86, 0.8)',
                            borderColor: 'rgba(255, 206, 86, 1)',
                            borderWidth: 1
                        }
                    ];

                    chart.data.labels = labels;
                    chart.data.datasets = datasets;
                    chart.update();

                    // Calculate and display the average skin health condition
                    let averageSkinHealth = calculateAverageSkinHealth(response);
                    $('#averageScore').text(`Average Skin Health Condition: ${averageSkinHealth.toFixed(2)}`);
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
