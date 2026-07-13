<?php include(__DIR__ . '/../layout/header.php'); ?>

<div class="xs-pd-20-10 pd-ltr-20">
    <div class="row pb-10">
        <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
            <div class="card-box height-100-p widget-style3">
                <div class="d-flex flex-wrap">
                    <div class="widget-data">
                        <div class="weight-700 font-24 text-dark"><?= $pelanggan; ?></div>
                        <div class="font-14 text-secondary weight-500">
                            Total Pelanggan
                        </div>
                    </div>
                    <div class="widget-icon">
                        <div class="icon" data-color="#00eccf">
                            <i class="icon-copy fa fa-users"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
            <div class="card-box height-100-p widget-style3">
                <div class="d-flex flex-wrap">
                    <div class="widget-data">
                        <div class="weight-700 font-24 text-dark"><?= $total_pesanan; ?></div>
                        <div class="font-14 text-secondary weight-500">
                            Total Pesanan
                        </div>
                    </div>
                    <div class="widget-icon">
                        <div class="icon" data-color="#ff5b5b">
                            <i class="icon-copy dw dw-shopping-cart"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
            <div class="card-box height-100-p widget-style3">
                <div class="d-flex flex-wrap">
                    <div class="widget-data">
                        <div class="weight-700 font-24 text-dark"><?= $pesanan_today; ?></div>
                        <div class="font-14 text-secondary weight-500">
                            Total Pesanan Hari Ini
                        </div>
                    </div>
                    <div class="widget-icon">
                        <div class="icon">
                            <i class="icon-copy fa fa-calendar-check-o"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
            <div class="card-box height-100-p widget-style3">
                <div class="d-flex flex-wrap">
                    <div class="widget-data">
                        <div class="weight-700 font-24 text-dark"><?= $pesanan_proses; ?></div>
                        <div class="font-14 text-secondary weight-500">
                            Total Pesanan Proses
                        </div>
                    </div>
                    <div class="widget-icon">
                        <div class="icon" data-color="#00eccf">
                            <i class="icon-copy dw dw-refresh"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
            <div class="card-box height-100-p widget-style3">
                <div class="d-flex flex-wrap">
                    <div class="widget-data">
                        <div class="weight-700 font-24 text-dark"><?= $pesanan_selesai; ?></div>
                        <div class="font-14 text-secondary weight-500">
                            Total Pesanan Selesai
                        </div>
                    </div>
                    <div class="widget-icon">
                        <div class="icon" data-color="#00eccf">
                            <i class="icon-copy dw dw-check"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
            <div class="card-box height-100-p widget-style3">
                <div class="d-flex flex-wrap">
                    <div class="widget-data">
                        <div class="weight-700 font-24 text-dark"><?= $pesanan_diambil; ?></div>
                        <div class="font-14 text-secondary weight-500">
                            Total Pesanan Diambil
                        </div>
                    </div>
                    <div class="widget-icon">
                        <div class="icon" data-color="#00eccf">
                            <i class="icon-copy fa fa-handshake-o"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
            <div class="card-box height-100-p widget-style3">
                <div class="d-flex flex-wrap">
                    <div class="widget-data">
                        <div class="weight-700 font-24 text-dark">Rp <?= number_format($total_pendapatan_kotor, 0, ',', '.') ?></div>
                        <div class="font-14 text-secondary weight-500">Total Pendapatan Kotor</div>
                    </div>
                    <div class="widget-icon">
                        <div class="icon" data-color="#ff9900">
                            <i class="icon-copy fa fa-money" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
            <div class="card-box height-100-p widget-style3">
                <div class="d-flex flex-wrap">
                    <div class="widget-data">
                        <div class="weight-700 font-24 text-dark">Rp <?= number_format($total_pendapatan_lunas, 0, ',', '.') ?></div>
                        <div class="font-14 text-secondary weight-500">Pendapatan Lunas</div>
                    </div>
                    <div class="widget-icon">
                        <div class="icon" data-color="#09cc06">
                            <i class="icon-copy fa fa-bank" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row pb-10">
        <div class="col-md-8 mb-20">
            <div class="card-box height-100-p pd-20">

                <div class="d-flex flex-wrap justify-content-between align-items-center pb-0 pb-md-3">
                    <div class="h5 mb-md-0">Aktivitas Pesanan Jahit</div>

                    <div class="form-group mb-md-0">
                        <select id="chartFilter" class="form-control form-control-sm selectpicker">
                            <option value="7 Hari Terakhir">7 Hari Terakhir</option>
                            <option value="Bulan Ini">Bulan Ini</option>
                            <option value="6 Bulan Terakhir">6 Bulan Terakhir</option>
                            <option value="Tahun Ini" selected>Tahun Ini</option>
                        </select>
                    </div>
                </div>

                <!-- Grafik -->
                <div id="activities-chart"></div>

            </div>
        </div>
        <div class="col-md-4 mb-20">
            <div class="card-box min-height-200px pd-20 mb-20" data-bgcolor="#455a64">
                <div class="d-flex justify-content-between pb-20 text-white">
                    <div class="icon h1 text-white">
                        <i class="fa fa-calendar" aria-hidden="true"></i>
                    </div>
                    <div class="font-14 text-right">
                        <div class="font-12">Bulan ini</div>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-end">
                    <div class="text-white">
                        <div class="font-14">Pesanan Bulan Ini</div>
                        <div class="font-24 weight-500"><?= $pesanan_bulan_ini ?></div>
                    </div>
                    <div class="max-width-150">
                        <div id="appointment-chart"></div>
                    </div>
                </div>
            </div>
            <div class="card-box min-height-200px pd-20" data-bgcolor="#265ed7">
                <div class="d-flex justify-content-between pb-20 text-white">
                    <div class="icon h1 text-white">
                        <i class="fa fa-clock-o" aria-hidden="true"></i>
                    </div>
                    <div class="font-14 text-right">
                        <div class="font-12">Belum diproses</div>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-end">
                    <div class="text-white">
                        <div class="font-14">Pesanan Menunggu</div>
                        <div class="font-24 weight-500"><?= $pesanan_menunggu ?></div>
                    </div>
                    <div class="max-width-150">
                        <div id="surgery-chart"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include(__DIR__ . '/../layout/footer.php'); ?>

<script>  
var options = {
	series: [
	{
		name: "Total Orders",
		data: <?= json_encode($bulan_total); ?>
	},
	{
		name: "Completed Orders",
		data: <?= json_encode($bulan_selesai); ?>
	}
	],
	chart: {
		height: 300,
		type: 'line',
		zoom: {
			enabled: false,
		},
		dropShadow: {
			enabled: true,
			color: '#000',
			top: 18,
			left: 7,
			blur: 16,
			opacity: 0.2
		},
		toolbar: {
			show: false
		}
	},
	colors: ['#f0746c', '#255cd3'],
	dataLabels: {
		enabled: false,
	},
	stroke: {
		width: [3,3],
		curve: 'smooth'
	},
	grid: {
		show: false,
	},
	markers: {
		colors: ['#f0746c', '#255cd3'],
		size: 5,
		strokeColors: '#ffffff',
		strokeWidth: 2,
		hover: {
			sizeOffset: 2
		}
	},
	xaxis: {
		categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
		labels:{
			style:{
				colors: '#8c9094'
			}
		}
	},
	yaxis: {
		min: 0,
		max: 35,
		labels:{
			style:{
				colors: '#8c9094'
			}
		}
	},
	legend: {
		position: 'top',
		horizontalAlign: 'right',
		floating: true,
		offsetY: 0,
		labels: {
			useSeriesColors: true
		},
		markers: {
			width: 10,
			height: 10,
		}
	}
};

if (document.querySelector("#activities-chart")) {
    var chart = new ApexCharts(document.querySelector("#activities-chart"), options);
    chart.render();

    var chartFilter = document.getElementById('chartFilter');
    if (chartFilter) {
        chartFilter.addEventListener('change', function() {
            var filterVal = this.value;
            var formData = new FormData();
            formData.append('filter', filterVal);

            fetch("<?= base_url('admin/dashboard/chart_data') ?>", {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if(data.error) {
                    console.error(data.error);
                    return;
                }
                
                chart.updateSeries([
                    {
                        name: "Total Orders",
                        data: data.total
                    },
                    {
                        name: "Completed Orders",
                        data: data.selesai
                    }
                ]);

                chart.updateOptions({
                    xaxis: {
                        categories: data.categories
                    }
                });
            })
            .catch(err => console.error(err));
        });
        
        // Trigger on load to show correct "Tahun Ini" data layout if needed, though PHP injects it initially
    }
}
</script>
