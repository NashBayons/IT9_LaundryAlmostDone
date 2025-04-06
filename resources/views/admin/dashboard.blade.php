<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="header">Admin Dashboard</div>

    <div class="dashboard">
        <div class="top-nav">
            <h1>Administrator</h1>
            <div class="nav-links">
                <a href="#">Order Track</a>
                <a href="{{ route('admin.employee.index') }}">Employee Assignment</a>
                <a href="#">Sales Report</a>
                <a href="{{ route('admin.inventory.index') }}">Inventory</a>
                
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-btn">
                        Logout
                    </button>
                </form>
            </div>
        </div>

        <div class="dashboard-content">
            <div class="track-label">Performance Metrics</div>
            <div class="charts-container">
                <div class="chart-container">
                    <h3 class="chart-title">Sales Distribution</h3>
                    <canvas id="pieChart"></canvas>
                </div>
                <div class="chart-container">
                    <h3 class="chart-title">Monthly Sales</h3>
                    <canvas id="lineChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(137.15deg, rgba(23, 232, 255, 0.00) 0%, rgba(23, 232, 255, 0.18) 86.00000143051147%, rgba(23, 232, 255, 0.20) 100%), 
                        linear-gradient(to left, rgba(7, 156, 214, 0.20), rgba(7, 156, 214, 0.20)), 
                        linear-gradient(119.69deg, rgba(93, 141, 230, 0.00) 0%, rgba(142, 176, 239, 0.10) 45.691317319869995%, rgba(36, 89, 188, 0.20) 96.88477516174316%), 
                        linear-gradient(to left, rgba(47, 53, 109, 0.20), rgba(47, 53, 109, 0.20));
            color: white;
            min-height: 100vh;
        }
        
        .header {
            background-color: rgba(26, 26, 26, 0.8);
            padding: 10px 20px;
            color: #9e9e9e;
            font-size: 14px;
            backdrop-filter: blur(5px);
        }
        
        .dashboard {
            background-color: rgba(28, 56, 86, 0.8);
            margin: 20px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(5px);
        }
        
        .top-nav {
            display: flex;
            background-color: rgba(26, 45, 69, 0.8);
            padding: 15px 20px;
            align-items: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .top-nav h1 {
            flex: 1;
            margin: 0;
            font-size: 24px;
            font-weight: normal;
        }
        
        .nav-links {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        
        .nav-links a {
            color: white;
            text-decoration: none;
            font-size: 16px;
            transition: color 0.3s;
            padding: 8px 12px;
            border-radius: 5px;
        }
        
        .nav-links a:hover {
            color: #17e8ff;
            background-color: rgba(255, 255, 255, 0.1);
        }
        
        .dashboard-content {
            padding: 20px;
        }
        
        .track-label {
            font-size: 18px;
            margin-bottom: 20px;
            color: rgba(255, 255, 255, 0.8);
        }
        
        .charts-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        
        .chart-container {
            flex: 1;
            min-width: 300px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
        
        .chart-title {
            margin-top: 0;
            margin-bottom: 15px;
            font-size: 16px;
            color: rgba(255, 255, 255, 0.9);
        }
        
        .logout-btn {
            background-color: rgba(255, 45, 32, 0.2);
            border: 1px solid rgba(255, 45, 32, 0.3);
            color: white;
            padding: 8px 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .logout-btn:hover {
            background-color: rgba(255, 45, 32, 0.3);
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const pieCtx = document.getElementById('pieChart').getContext('2d');
            const pieChart = new Chart(pieCtx, {
                type: 'pie',
                data: {
                    labels: ['Wash & Fold', 'Dry Cleaning', 'Ironing', 'Special Items'],
                    datasets: [{
                        data: [45, 25, 20, 10],
                        backgroundColor: [
                            'rgba(23, 232, 255, 0.7)',
                            'rgba(7, 156, 214, 0.7)',
                            'rgba(36, 89, 188, 0.7)',
                            'rgba(47, 53, 109, 0.7)'
                        ],
                        borderColor: [
                            'rgba(23, 232, 255, 1)',
                            'rgba(7, 156, 214, 1)',
                            'rgba(36, 89, 188, 1)',
                            'rgba(47, 53, 109, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'right',
                            labels: {
                                color: 'white'
                            }
                        }
                    }
                }
            });

            const lineCtx = document.getElementById('lineChart').getContext('2d');
            const lineChart = new Chart(lineCtx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    datasets: [{
                        label: 'Total Sales',
                        data: [12000, 19000, 15000, 18000, 22000, 25000],
                        backgroundColor: 'rgba(23, 232, 255, 0.2)',
                        borderColor: 'rgba(23, 232, 255, 1)',
                        borderWidth: 2,
                        tension: 0.4,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(255, 255, 255, 0.1)'
                            },
                            ticks: {
                                color: 'white'
                            }
                        },
                        x: {
                            grid: {
                                color: 'rgba(255, 255, 255, 0.1)'
                            },
                            ticks: {
                                color: 'white'
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            labels: {
                                color: 'white'
                            }
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>