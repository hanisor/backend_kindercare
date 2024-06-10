document.addEventListener('DOMContentLoaded', function() {
    const token = sessionStorage.getItem('token');

    function fetchCaregiverCount() {
        fetch('/api/caregiver-count', {
            method: 'GET',
            headers: {
                'Authorization': 'Bearer ' + token
            }
        })
        .then(response => {
            if (!response.ok) {
                console.log('Response status:', response.status); // Log response status
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            console.log('Fetched caregiver data:', data); // Debugging log
            document.getElementById('caregiverCount').textContent = data.totalCaregivers;
            updateCaregiverChart(data.totalCaregivers);
        })
        .catch(error => {
            console.error('Error fetching caregiver count:', error);
            document.getElementById('caregiverCount').textContent = 'Error';
        });
    }

    function updateCaregiverChart(totalCaregivers) {
        var ctx2 = document.getElementById('totalCaregiver').getContext('2d');
        var caregiversChart = new Chart(ctx2, {
            type: 'pie',
            data: {
                labels: ['Full Day'],
                datasets: [{
                    label: 'Number of Caregivers',
                    data: [totalCaregivers], // Ensure this data matches your API response
                    backgroundColor: ['#cc65fe'],
                }]
            },
            options: {
                responsive: true
            }
        });
    }

    function fetchChildCounts() {
        fetch('/api/childgroup-count', {
            method: 'GET',
            headers: {
                'Authorization': 'Bearer ' + token
            }
        })
        .then(response => {
            if (!response.ok) {
                console.log('Response status:', response.status); // Log response status
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            console.log('Fetched child group data:', data); // Debugging log
            document.getElementById('morningSessionCount').textContent = data.morningSessionCounts;
            document.getElementById('afternoonSessionCount').textContent = data.afternoonSessionCounts;
            document.getElementById('fullDaySessionCount').textContent = data.fullDaySessionCounts;
            updateChildSessionChart(data);
        })
        .catch(error => {
            console.error('Error fetching group counts:', error);
            document.getElementById('morningSessionCount').textContent = 'Error';
            document.getElementById('afternoonSessionCount').textContent = 'Error';
            document.getElementById('fullDaySessionCount').textContent = 'Error';
        }); 
    }

    function updateChildSessionChart(data) {
        console.log('Child session data:', data); // Debugging log
        var ctx = document.getElementById('childrenSession').getContext('2d');
        var morningCount = data.morningSessionCounts.length > 0 ? data.morningSessionCounts[0] : 0;
        var afternoonCount = data.afternoonSessionCounts.length > 0 ? data.afternoonSessionCounts[0] : 0;
        var fullDayCount = data.fullDaySessionCounts.length > 0 ? data.fullDaySessionCounts[0] : 0;
    
        var childrenSessionChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Morning Session', 'Afternoon Session', 'Full Day Session'],
                datasets: [{
                    label: 'Number of Children',
                    data: [morningCount, afternoonCount, fullDayCount],
                    backgroundColor: ['#ff6384', '#ff8717', '#ffec17'],
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: '#000000', // Y-axis labels color
                            stepSize: 2,     // Increment by 1
                            callback: function(value, index, values) {
                                return Number.isInteger(value) ? value : null;
                            }
                        },
                       
                    },
                    x: {
                        ticks: {
                            color: '#000000' // X-axis labels color
                        },
                        title: {
                            display: true,
                            text: 'Session Type',
                            color: '#000000' // X-axis title color
                        }
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            color: '#000000' // Legend labels color
                        }
                    }
                }
            }
        });
    }
    
    

    fetchCaregiverCount();
    fetchChildCounts();
});


function signOut() {
    const token = sessionStorage.getItem('token');

    fetch('/api/logout', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + token
        }
    })
    .then(response => {
        if (!response.ok) {
            console.log('Response status:', response.status); // Log response status
            throw new Error('Network response was not ok.');
        }
        return response.json();
    })
    .then(data => {
        console.log('Response:', data);
        window.location.replace('/caregiver-login');
    })
    .catch(error => {
        console.error('Error during fetch:', error);
    });
}

(function($) {
	'use strict';
	$(function() {
		var salesDifferencedata = {
			labels: ["50+", "35-50", "25-35", "18-25", "0-18"],
			datasets: [{
				label: 'Best Sellers',
				data: [22, 28, 18, 20, 12],
				backgroundColor: [
						'#8169f2',
						'#6a4df5',
						'#4f2def',
						'#2b0bc5',
						'#180183',
				],
				borderColor: [
						'#8169f2',
						'#6a4df5',
						'#4f2def',
						'#2b0bc5',
						'#180183',
				],
				borderWidth: 2,
				fill: false
			}],
		};
		var salesDifferenceOptions = {
			scales: {
				xAxes: [{
					position: 'bottom',
					display: false,
					gridLines: {
							display: false,
							drawBorder: true,
					},
					ticks: {
							display: false ,//this will remove only the label
							beginAtZero: true
					}
				}],
				yAxes: [{
					display: true,
					gridLines: {
						drawBorder: true,
						display: false,
					},
					ticks: {
						beginAtZero: true
					},
				}]
			},
			legend: {
				display: false
			},
			tooltips: {
				show: false,
				backgroundColor: 'rgba(31, 59, 179, 1)',
			},
			plugins: {
			datalabels: {
					display: true,
					align: 'start',
					color: 'white',
				}
			}				

		};
		if ($("#salesDifference").length) {
			var barChartCanvas = $("#salesDifference").get(0).getContext("2d");
			// This will get the first returned node in the jQuery collection.
			var barChart = new Chart(barChartCanvas, {
				type: 'horizontalBar',
				data: salesDifferencedata,
				options: salesDifferenceOptions,

			});
		}
		var bestSellersData = {
			datasets: [{
				data: [20, 15, 20, 35, 10],
				backgroundColor: [
					'#ee5b5b',
					'#fcd53b',
					'#0bdbb8',
					'#464dee',
					'#0ad7f7'
				],
				borderColor: [
					'#ee5b5b',
					'#fcd53b',
					'#0bdbb8',
					'#464dee',
					'#0ad7f7'
				],
			}],
			// These labels appear in the legend and in the tooltips when hovering different arcs
			labels: [
				'Automotive',
				'Books',
				'Software',
				'Toys',
				'Video games'
			]
		};
		var bestSellersOptions = {
			responsive: true,
			cutoutPercentage: 80,
			legend: {
					display: false,
			},
			animation: {
					animateScale: true,
					animateRotate: true
			},
			plugins: {
				datalabels: {
					 display: false,
					 align: 'center',
					 anchor: 'center'
				}
			}				
	
		};
		if ($("#bestSellers").length) {
			var pieChartCanvas = $("#bestSellers").get(0).getContext("2d");
			var pieChart = new Chart(pieChartCanvas, {
				type: 'doughnut',
				data: bestSellersData,
				options: bestSellersOptions
			});
		}

		var barChartStackedData = {
			datasets: [{
				label: 'Instagram (40%)',
				data: [60],
				backgroundColor: [
					'#ee5b5b'

				],
				borderColor: [
					'#ee5b5b'
				],
				borderWidth: 1,
				fill: false
			},
			{
				label: 'Facebook',
				data: [25],

				backgroundColor: [
					'#fcd53b'
				],
				borderColor: [
					'#fcd53b',

				],
				borderWidth: 1,
				fill: false
			},
			{
				label: 'Website',
				data: [10],

				backgroundColor: [
					'#0bdbb8'
				],
				borderColor: [
					'#0bdbb8',

				],
				borderWidth: 1,
				fill: false
			},
			{
				label: 'Youtube',
				data: [15],

				backgroundColor: [
					'#444bee'
				],
				borderColor: [
						"#444bee",

				],
				borderWidth: 1,
				fill: false
			}]
		};
		var barChartStackedOptions = {
			scales: {
				xAxes: [{
					display: false,
					stacked: true,
					gridLines: {
							display: false //this will remove only the label
					},
				}],
				yAxes: [{
					stacked: true,
					display: false,
				}]
			},
			legend: {
				display: false,
				position: "bottom"
			},
			elements: {
				point: {
						radius: 0
				},
				plugins: {
					datalabels: {
						display: false,
						align: 'center',
						anchor: 'center'
					}
				}				
		
		}
		};
		if ($("#barChartStacked").length) {
			var barChartCanvas = $("#barChartStacked").get(0).getContext("2d");
			// This will get the first returned node in the jQuery collection.
			var barChart = new Chart(barChartCanvas, {
				type: 'horizontalBar',
				data: barChartStackedData,
				options: barChartStackedOptions
			});
		}

		var revenueChartData = {
			labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "No", "Dec"],
			datasets: [{
				label: 'Margin',
				data: [45, 45, 70, 70, 50, 50, 70, 60, 65, 60, 55, 55],
				backgroundColor: [
						'#0ddbb9',
				],
				borderColor: [
						'#0ddbb9'
				],
				borderWidth: 2,
				fill: false,
			},
			{
				label: 'Product',
				borderDash: [3, 4],
				data: [35, 35, 60, 60, 40, 40, 60, 50, 55, 50, 45, 45],
				borderColor: [
						'#464dee',
				],
				borderWidth: 2,
				fill: false,
				pointBorderWidth: 4,
			},
			{
				label: 'Cost',
				data: [25, 25, 50, 50, 30, 30, 50, 40, 45, 40, 35, 35],
				borderColor: [
						'#ee5b5b',
				],
				borderWidth: 2,
				fill: false,
				pointBorderWidth: 4,
			}],
		};
		var revenueChartOptions = {
			scales: {
					yAxes: [{
						display: true,
						gridLines: {
							drawBorder: false,
							display: false,
						},
					}],
					xAxes: [{
						position: 'bottom',
						gridLines: {
							drawBorder: false,
							display: false,
						},
						ticks: {
							beginAtZero: true,
							stepSize: 30
						}
					}],

			},
			legend: {
					display: false,
			},
			legendCallback: function(chart) {
				var text = [];
				text.push('<ul class="' + chart.id + '-legend">');
				for (var i = 0; i < chart.data.datasets.length; i++) {
					text.push('<li><span class="legend-box" style="background:' + chart.data.datasets[i].borderColor + ';"></span><span class="legend-label" style="">');
					if (chart.data.datasets[i].label) {
							text.push(chart.data.datasets[i].label);
					}
					text.push('</span></li>');
				}
				text.push('</ul>');
				return text.join("");
			},
			elements: {
				point: {
					radius: 0
				},
				line: {
					tension: 0
				}
			},
			tooltips: {
				backgroundColor: 'rgba(2, 171, 254, 1)',
			},
			plugins: {
				datalabels: {
					display: false,
					align: 'center',
					anchor: 'center'
				}
			}				
	
		};
		if ($("#revenue-for-last-month-chart").length) {
			var lineChartCanvas = $("#revenue-for-last-month-chart").get(0).getContext("2d");
			var saleschart = new Chart(lineChartCanvas, {
				type: 'line',
				data: revenueChartData,
				options: revenueChartOptions
			});
			document.getElementById('revenuechart-legend').innerHTML = saleschart.generateLegend();
		}

		var serveLoadingData = {
			labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "No", "Dec"],
			datasets: [{
				label: 'Margin',
				data: [45, 45, 70, 70, 50, 50, 70, 60, 65, 60, 55, 55],
				backgroundColor: [
						'#0ddbb9',
				],
				borderColor: [
						'#0ddbb9'
				],
				borderWidth: 2,
				fill: false,
			},
			{
				label: 'Product',
				borderDash: [3, 4],
				data: [35, 35, 60, 60, 40, 40, 60, 50, 55, 50, 45, 45],
				borderColor: [
						'#464dee',
				],
				borderWidth: 2,
				fill: false,
				pointBorderWidth: 4,
			},
			{
				label: 'Cost',
				data: [25, 25, 50, 50, 30, 30, 50, 40, 45, 40, 35, 35],
				borderColor: [
						'#ee5b5b',
				],
				borderWidth: 2,
				fill: false,
				pointBorderWidth: 4,
			}],
		};
		var serveLoadingOptions = {
			scales: {
				yAxes: [{
					display: true,
					gridLines: {
						drawBorder: false,
						display: false,
					},
				}],
				xAxes: [{
					position: 'bottom',
					gridLines: {
						drawBorder: false,
						display: false,
					},
					ticks: {
						beginAtZero: false,
						stepSize: 200
					}
				}],

			},
			legend: {
				display: false,
			},
			legendCallback: function(chart) {
				var text = [];
				text.push('<ul class="' + chart.id + '-legend">');
				for (var i = 0; i < chart.data.datasets.length; i++) {
					text.push('<li><span class="legend-box" style="background:' + chart.data.datasets[i].borderColor + ';"></span><span class="legend-label" style="">');
					if (chart.data.datasets[i].label) {
							text.push(chart.data.datasets[i].label);
					}
					text.push('</span></li>');
				}
				text.push('</ul>');
				return text.join("");
			},
			elements: {
				point: {
					radius: 0
				},
				line: {
					tension: 0
				}
			},
			tooltips: {
				backgroundColor: 'rgba(2, 171, 254, 1)',
			},
			plugins: {
				datalabels: {
					display: false,
					align: 'center',
					anchor: 'center'
				}
			}				
	
		};
		if ($("#serveLoading").length) {
			var lineChartCanvas = $("#serveLoading").get(0).getContext("2d");
			var saleschart = new Chart(lineChartCanvas, {
				type: 'line',
				data: serveLoadingData,
				options: serveLoadingOptions
			});
			document.getElementById('serveLoading-legend').innerHTML = saleschart.generateLegend();
		}
		var dataManagedData = {
			labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "No", "Dec"],
			datasets: [{
						label: 'Margin',
						data: [45, 45, 70, 70, 50, 50, 70, 60, 65, 60, 55, 55],
						backgroundColor: [
							'#0ddbb9',
						],
						borderColor: [
							'#0ddbb9'
						],
						borderWidth: 2,
						fill: false,
					},
					{
						label: 'Product',
						borderDash: [3, 4],
						data: [35, 35, 60, 60, 40, 40, 60, 50, 55, 50, 45, 45],
						borderColor: [
								'#464dee',
						],
						borderWidth: 2,
						fill: false,
						pointBorderWidth: 4,
					},
					{
						label: 'Cost',
						data: [25, 25, 50, 50, 30, 30, 50, 40, 45, 40, 35, 35],
						borderColor: [
								'#ee5b5b',
						],
						borderWidth: 2,
						fill: false,
						pointBorderWidth: 4,
					}
			],
		};
		var dataManagedOptions = {
			scales: {
				yAxes: [{
					display: true,
					gridLines: {
						drawBorder: false,
						display: false,
					},
				}],
				xAxes: [{
					position: 'bottom',
					gridLines: {
						drawBorder: false,
						display: false,
					},
					ticks: {
						beginAtZero: false,
						stepSize: 200
					}
				}],
			},
			legend: {
				display: false,
			},
			legendCallback: function(chart) {
				var text = [];
				text.push('<ul class="' + chart.id + '-legend">');
				for (var i = 0; i < chart.data.datasets.length; i++) {
					text.push('<li><span class="legend-box" style="background:' + chart.data.datasets[i].borderColor + ';"></span><span class="legend-label" style="">');
					if (chart.data.datasets[i].label) {
							text.push(chart.data.datasets[i].label);
					}
					text.push('</span></li>');
				}
				text.push('</ul>');
				return text.join("");
			},
			elements: {
				point: {
					radius: 0
				},
				line: {
					tension: 0
				}
			},
			tooltips: {
				backgroundColor: 'rgba(2, 171, 254, 1)',
			},
			plugins: {
				datalabels: {
					display: false,
					align: 'center',
					anchor: 'center'
				}
			}					
		};
		if ($("#dataManaged").length) {
			var lineChartCanvas = $("#dataManaged").get(0).getContext("2d");
			var saleschart = new Chart(lineChartCanvas, {
				type: 'line',
				data: dataManagedData,
				options: serveLoadingOptions
			});
			document.getElementById('dataManaged-legend').innerHTML = saleschart.generateLegend();
		}
		var salesTraficData = {
			labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "No", "Dec"],
			datasets: [{
				label: 'Margin',
				data: [45, 45, 70, 70, 50, 50, 70, 60, 65, 60, 55, 55],
				backgroundColor: [
						'#0ddbb9',
				],
				borderColor: [
						'#0ddbb9'
				],
				borderWidth: 2,
				fill: false,
				},
				{
				label: 'Product',
				borderDash: [3, 4],
				data: [35, 35, 60, 60, 40, 40, 60, 50, 55, 50, 45, 45],
				borderColor: [
						'#464dee',
				],
				borderWidth: 2,
				fill: false,
				pointBorderWidth: 4,
				},
				{
				label: 'Cost',
				data: [25, 25, 50, 50, 30, 30, 50, 40, 45, 40, 35, 35],
				borderColor: [
						'#ee5b5b',
				],
				borderWidth: 2,
				fill: false,
				pointBorderWidth: 4,
				}
			],
		};
		var salesTraficOptions = {
			scales: {
				yAxes: [{
					display: true,
					gridLines: {
						drawBorder: false,
						display: false,
					},
				}],
				xAxes: [{
					position: 'bottom',
					gridLines: {
						drawBorder: false,
						display: false,
					},
					ticks: {
						beginAtZero: false,
						stepSize: 200
					}
				}],

			},
			legend: {
				display: false,
			},
			legendCallback: function(chart) {
				var text = [];
				text.push('<ul class="' + chart.id + '-legend">');
				for (var i = 0; i < chart.data.datasets.length; i++) {
					text.push('<li><span class="legend-box" style="background:' + chart.data.datasets[i].borderColor + ';"></span><span class="legend-label" style="">');
					if (chart.data.datasets[i].label) {
							text.push(chart.data.datasets[i].label);
					}
					text.push('</span></li>');
				}
				text.push('</ul>');
				return text.join("");
			},
			elements: {
					point: {
						radius: 0
					},
					line: {
						tension: 0
					}
			},
			tooltips: {
					backgroundColor: 'rgba(2, 171, 254, 1)',
			},
			plugins: {
				datalabels: {
					display: false,
					align: 'center',
					anchor: 'center'
				}
			}				
	
		};
		if ($("#salesTrafic").length) {
			var lineChartCanvas = $("#salesTrafic").get(0).getContext("2d");
			var saleschart = new Chart(lineChartCanvas, {
				type: 'line',
				data: salesTraficData,
				options: salesTraficOptions
			});
			document.getElementById('salesTrafic-legend').innerHTML = saleschart.generateLegend();
		}

		var visitorsTodayData = {
			labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug"],
			datasets: [
				{
				label: 'Cost',
				data: [15, 25, 20, 18, 24, 20, 16, 20],
				backgroundColor: [
						'rgba(238, 91, 91, .9)',
				],
				borderColor: [
						'#ee5b5b',
				],
				borderWidth: 2,
				fill: true,
				pointBorderWidth: 4,
				},
				{
				label: 'Product',
				data: [20, 30, 25, 23, 29, 25, 21, 25],
				backgroundColor: [
						'rgba(70, 77, 238, 1)',
				],
				borderColor: [
						'#464dee',
				],
				borderWidth: 2,
				fill: true,
				pointBorderWidth: 4,
				},
				{
				label: 'Margin',
				data: [25, 35, 30, 28, 33, 30, 26, 30],
				backgroundColor: [
						'rgba(81, 225, 195, .9)',
				],
				borderColor: [
						'#51e1c3'
				],
				borderWidth: 2,
				fill: true,
				},
			],
		};
		var visitorsTodayOptions = {
			scales: {
				yAxes: [{
					display: false,
					gridLines: {
						drawBorder: false,
						display: false,
					},
				}],
				xAxes: [{
					position: 'bottom',
					display: true,
					gridLines: {
						drawBorder: false,
						display: true,
						color: "#f2f2f2",
						borderDash: [8, 4],
					},
					ticks: {
						beginAtZero: false,
						stepSize: 200
					}
				}],
			},
			legend: {
				display: false,
			},
			elements: {
					point: {
						radius: 0
					},
			},
			plugins: {
				datalabels: {
					display: false,
					align: 'center',
					anchor: 'center'
				}
			}				
		};
		if ($("#visitorsToday").length) {
			var lineChartCanvas = $("#visitorsToday").get(0).getContext("2d");
			var saleschart = new Chart(lineChartCanvas, {
				type: 'line',
				data: visitorsTodayData,
				options: visitorsTodayOptions
			});
		}
		if ($('#circleProgress1').length) {
			var bar = new ProgressBar.Circle(circleProgress1, {
				color: '#0aadfe',
				strokeWidth: 10,
				trailWidth: 10,
				easing: 'easeInOut',
				duration: 1400,
				width: 42,
			});
			bar.animate(.18); // Number from 0.0 to 1.0
		}
		if ($('#circleProgress2').length) {
			var bar = new ProgressBar.Circle(circleProgress2, {
				color: '#fa424a',
				strokeWidth: 10,
				trailWidth: 10,
				easing: 'easeInOut',
				duration: 1400,
				width: 42,

			});
			bar.animate(.36); // Number from 0.0 to 1.0
		}
		var newClientData = {
			labels: ["Jan", "Feb", "Mar", "Apr", "May"],
			datasets: [{
				label: 'Margin',
				data: [35, 37, 34, 36, 32],
				backgroundColor: [
						'#f7f7f7',
				],
				borderColor: [
						'#dcdcdc'
				],
				borderWidth: 2,
				fill: true,
			},],
		};
		var newClientOptions = {
			scales: {
				yAxes: [{
					display: false,
				}],
				xAxes: [{
					display: false,
				}],
			},
			legend: {
				display: false,
			},
			elements: {
				point: {
					radius: 0
				},		
			},
			plugins: {
				datalabels: {
					display: false,
					align: 'center',
					anchor: 'center'
				}
			}				
		};
		if ($("#newClient").length) {
			var lineChartCanvas = $("#newClient").get(0).getContext("2d");
			var saleschart = new Chart(lineChartCanvas, {
				type: 'line',
				data: newClientData,
				options: newClientOptions
			});
		}
		var allProductsData = {
			labels: ["Jan", "Feb", "Mar", "Apr", "May"],
			datasets: [{
				label: 'Margin',
				data: [37, 36, 37, 35, 36],
				backgroundColor: [
						'#f7f7f7',
				],
				borderColor: [
						'#dcdcdc'
				],
				borderWidth: 2,
				fill: true,
			}, ],
		};
		var allProductsOptions = {
			scales: {
				yAxes: [{
					display: false,
				}],
				xAxes: [{
					display: false,
				}],
			},
			legend: {
				display: false,
			},
			elements: {
				point: {
					radius: 0
				},
			},
			plugins: {
				datalabels: {
					display: false,
					align: 'center',
					anchor: 'center'
				}
			}				
	
		};
		if ($("#allProducts").length) {
			var lineChartCanvas = $("#allProducts").get(0).getContext("2d");
			var saleschart = new Chart(lineChartCanvas, {
				type: 'line',
				data: allProductsData,
				options: allProductsOptions
			});
		}
		var invoicesData = {
			labels: ["Jan", "Feb", "Mar", "Apr", "May"],
			datasets: [{
				label: 'Margin',
				data: [35, 37, 34, 36, 32],
				backgroundColor: [
						'#f7f7f7',
				],
				borderColor: [
						'#dcdcdc'
				],
				borderWidth: 2,
				fill: true,
			}, ],
		};
		var     sOptions = {
			scales: {
				yAxes: [{
					display: false,
				}],
				xAxes: [{
					display: false,
				}],
			},
			legend: {
				display: false,
			},
			elements: {
					point: {
						radius: 0
					},
			},
			plugins: {
				datalabels: {
					display: false,
					align: 'center',
					anchor: 'center'
				}
			}				
	
		};
		if ($("#invoices").length) {
			var lineChartCanvas = $("#invoices").get(0).getContext("2d");
			var saleschart = new Chart(lineChartCanvas, {
				type: 'line',
				data: invoicesData,
				options: invoicesOptions
			});
		}
		var projectsData = {
			labels: ["Jan", "Feb", "Mar", "Apr", "May"],
			datasets: [{
				label: 'Margin',
				data: [38, 39, 37, 40, 36],
					backgroundColor: [
							'#f7f7f7',
					],
				borderColor: [
						'#dcdcdc'
				],
				borderWidth: 2,
				fill: true,
			}, ],
		};
		var projectsOptions = {
			scales: {
				yAxes: [{
					display: false,
				}],
				xAxes: [{
					display: false,
				}],
			},
			legend: {
				display: false,
			},
			elements: {
				point: {
					radius: 0
				},
			},
			plugins: {
				datalabels: {
					display: false,
					align: 'center',
					anchor: 'center'
				}
			}					
		};
		if ($("#projects").length) {
			var lineChartCanvas = $("#projects").get(0).getContext("2d");
			var saleschart = new Chart(lineChartCanvas, {
				type: 'line',
				data: projectsData,
				options: projectsOptions
			});
		}
		var orderRecievedData = {
			labels: ["Jan", "Feb", "Mar", "Apr", "May"],
			datasets: [{
				label: 'Margin',
				data: [35, 37, 34, 36, 32],
				backgroundColor: [
						'#f7f7f7',
				],
				borderColor: [
						'#dcdcdc'
				],
				borderWidth: 2,
				fill: true,
			}, ],
		};
		var orderRecievedOptions = {
			scales: {
				yAxes: [{
					display: false,
				}],
				xAxes: [{
					display: false,
				}],
			},
			legend: {
				display: false,
			},
			elements: {
				point: {
					radius: 0
				},
			},
			plugins: {
				datalabels: {
					display: false,
					align: 'center',
					anchor: 'center'
				}
			}				
	
		};
		if ($("#orderRecieved").length) {
			var lineChartCanvas = $("#orderRecieved").get(0).getContext("2d");
			var saleschart = new Chart(lineChartCanvas, {
				type: 'line',
				data: orderRecievedData,
				options: orderRecievedOptions
			});
		}
		var transactionsData = {
			labels: ["Jan", "Feb", "Mar", "Apr", "May"],
			datasets: [{
				label: 'Margin',
				data: [38, 35, 36, 38, 34],
				backgroundColor: [
						'#f7f7f7',
				],
				borderColor: [
						'#dcdcdc'
				],
				borderWidth: 2,
				fill: true,
			}, ],
		};
		var transactionsOptions = {
			scales: {
				yAxes: [{
					display: false,
				}],
				xAxes: [{
					display: false,
				}],
			},
			legend: {
				display: false,
			},
			elements: {
				point: {
					radius: 0
				},
			},
			plugins: {
				datalabels: {
					display: false,
					align: 'center',
					anchor: 'center'
				}
			}				
		};
		if ($("#transactions").length) {
			var lineChartCanvas = $("#transactions").get(0).getContext("2d");
			var saleschart = new Chart(lineChartCanvas, {
				type: 'line',
				data: transactionsData,
				options: transactionsOptions
			});
		}
		var supportTrackerData = {
			labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec", ],
			datasets: [{
				label: 'New Tickets',
				data: [640, 750, 500, 400, 1200, 650, 550, 450, 400],
				backgroundColor: [
					'#464dee', '#464dee', '#464dee', '#464dee', '#464dee', '#464dee', '#464dee', '#464dee', '#464dee', 
				],
				borderColor: [
					'#464dee', '#464dee', '#464dee', '#464dee',  '#464dee', '#464dee', '#464dee', '#464dee', '#464dee', 
				],
				borderWidth: 1,
				fill: false
			},
			{
					label: 'Open Tickets',
					data: [800, 550, 700, 600, 1100, 650, 550, 650, 850],					
					backgroundColor: [
						'#d8d8d8', '#d8d8d8', '#d8d8d8', '#d8d8d8', '#d8d8d8', '#d8d8d8', '#d8d8d8', '#d8d8d8', '#d8d8d8', 
					],
					borderColor: [
						'#d8d8d8', '#d8d8d8', '#d8d8d8', '#d8d8d8', '#d8d8d8', '#d8d8d8', '#d8d8d8', '#d8d8d8', '#d8d8d8', 
					],
					borderWidth: 1,
					fill: false
			}
			]
		};
		var supportTrackerOptions = {
			scales: {
				xAxes: [{
				stacked: true,
				barPercentage: 0.6,
				position: 'bottom',
				display: true,
				gridLines: {
					display: false,
					drawBorder: false,
				},
				ticks: {
					display: true, //this will remove only the label
					stepSize: 300,
				}
				}],
				yAxes: [{
					stacked: true,
					display: true,
					gridLines: {
						drawBorder: false,
						display: true,
						color: "#f0f3f6",
						borderDash: [8, 4],
					},
					ticks: {
						beginAtZero: true,
						callback: function(value, index, values) {
						return '$' + value;
						}
					},
				}]
			},
			legend: {
				display: false
			},
			legendCallback: function(chart) {
				var text = [];
				text.push('<ul class="' + chart.id + '-legend">');
				for (var i = 0; i < chart.data.datasets.length; i++) {
					text.push('<li><span class="legend-box" style="background:' + chart.data.datasets[i].backgroundColor[i] + ';"></span><span class="legend-label text-dark">');
					if (chart.data.datasets[i].label) {
							text.push(chart.data.datasets[i].label);
					}
					text.push('</span></li>');
				}
				text.push('</ul>');
				return text.join("");
			},
			tooltips: {
				backgroundColor: 'rgba(0, 0, 0, 1)',
			},
			plugins: {
				datalabels: {
					display: false,
					align: 'center',
					anchor: 'center'
				}
			}				
		};
		if ($("#supportTracker").length) {
			var barChartCanvas = $("#supportTracker").get(0).getContext("2d");
			// This will get the first returned node in the jQuery collection.
			var barChart = new Chart(barChartCanvas, {
				type: 'bar',
				data: supportTrackerData,
				options: supportTrackerOptions
			});
			document.getElementById('support-tracker-legend').innerHTML = barChart.generateLegend();
		}
		var productorderGage = new JustGage({
			id: 'productorder-gage',
			value: 3245,
			min: 0,
			max: 5000,
			hideMinMax: true,
			symbol: 'K',
			label: 'You have done 57.6% more ordes today',
			valueFontColor: "#001737",
			labelFontColor: "#001737",
			gaugeWidthScale: 0.3,
			counter: true,
			relativeGaugeSize: true,
			gaugeColor: "#f0f0f0",
			levelColors: [ "#fcd53b" ]
		});
		$("#productorder-gage").append('<div class="product-order"><div class="icon-inside-circle"><i class="mdi mdi-basket"></i></div></div>');

		// Remove pro banner on close
    document.querySelector('#bannerClose').addEventListener('click',function() {
			$('#pro-banner').slideUp();
    });
	});
})(jQuery);