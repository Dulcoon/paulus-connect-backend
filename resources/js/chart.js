// Ambil data dari Laravel (pastikan data ini di-embed di view)
const chartData = window.chartData || {};
console.log(chartData);

// Format data untuk chart
const totalUsersData = chartData.totalUsers.map(item => ({
    x: item.date, // Tanggal pendaftaran
    y: item.count, // Jumlah total pengguna
}));

// Cocokkan data verifiedUsers dengan tanggal dari totalUsers
const verifiedUsersData = chartData.totalUsers.map(item => {
    const verifiedItem = chartData.verifiedUsers.find(v => v.date === item.date);
    return {
        x: item.date, // Tanggal pendaftaran
        y: verifiedItem ? verifiedItem.count : 0, // Jumlah pengguna terverifikasi (0 jika tidak ada)
    };
});

// Konfigurasi chart
const options = {
    colors: ["#1A56DB", "#FDBA8C"],
    series: [
        {
            name: "Terverifikasi",
            color: "#1A56DB",
            data: verifiedUsersData, // Data pengguna terverifikasi
        },
        {
            name: "Total Pendaftar",
            color: "#FDBA8C",
            data: totalUsersData, // Data total pengguna
        },
    ],
    chart: {
        type: "bar",
        height: "445px",
        fontFamily: "Inter, sans-serif",
        toolbar: {
            show: true,
        },
    },
    plotOptions: {
        bar: {
            horizontal: false,
            columnWidth: "70%",
            borderRadiusApplication: "end",
            borderRadius: 8,
        },
    },
    tooltip: {
        enabled: true,
        x: {
            show: true,
        },
        y: {
            show: true,
        },
        shared: true,
        intersect: false,
        style: {
            fontFamily: "Inter, sans-serif",
        },
    },
    states: {
        hover: {
            filter: {
                type: "darken",
                value: 1,
            },
        },
    },
    stroke: {
        show: true,
        width: 0,
        colors: ["transparent"],
    },
    grid: {
        show: false,
        strokeDashArray: 4,
        padding: {
            left: 2,
            right: 2,
            top: -14,
        },
    },
    dataLabels: {
        enabled: false,
    },
    legend: {
        show: true, // Tampilkan legenda
    },
    xaxis: {
        floating: false,
        labels: {
            show: true,
            style: {
                fontFamily: "Inter, sans-serif",
                cssClass: "text-xs font-normal fill-gray-500 dark:fill-gray-400",
            },
        },
        axisBorder: {
            show: false,
        },
        axisTicks: {
            show: false,
        },
    },
    yaxis: {
        show: true, // Tampilkan sumbu Y
        labels: {
            style: {
                fontFamily: "Inter, sans-serif",
                cssClass: "text-xs font-normal fill-gray-500 dark:fill-gray-400",
            },
        },
    },
    fill: {
        opacity: 1,
    },
};

// Render chart jika elemen ada
if (document.getElementById("column-chart") && typeof ApexCharts !== "undefined") {
    const chart = new ApexCharts(document.getElementById("column-chart"), options);
    chart.render();
}