var revenueCtx = document.getElementById("revenueChart").getContext("2d");
var revenueChart = new Chart(revenueCtx, {
  type: "line",
  data: {
    labels: [
      "Jan",
      "Feb",
      "Mar",
      "Apr",
      "May",
      "Jun",
      "Jul",
      "Aug",
      "Sep",
      "Oct",
      "Nov",
      "Dec",
    ],
    datasets: [
      {
        label: "Revenue",

        data: [40, 30, 50, 40, 60, 50, 70, 60, 80, 70, 90, 80],
        borderColor: "rgb(133, 73, 4)",
        borderWidth: 1,
        pointBackgroundColor: "rgb(133, 73, 4)",

        pointHoverBackgroundColor: "#fff",
        pointHoverBorderColor: "rgb(133, 73, 4)",
      },
      {
        label: "Profit",
        data: [30, 20, 40, 30, 50, 40, 60, 50, 70, 60, 80, 70],
        borderColor: "rgba(240, 169, 15, 0.767)",
        borderWidth: 1,
        pointBackgroundColor: "rgba(240, 169, 15, 0.767)",

        pointHoverBackgroundColor: "#fff",
        pointHoverBorderColor: "rgba(240, 169, 15, 0.767)",
      },
      {
        label: "Profit",
        data: [20, 10, 30, 20, 40, 30, 50, 40, 60, 60, 80, 70],
        borderColor: "white",
        borderWidth: 1,
        pointBackgroundColor: "white",

        pointHoverBackgroundColor: "#fff",
        pointHoverBorderColor: "white",
      },
    ],
  },

  options: {
    responsive: true,
    scales: {
      x: {
        ticks: {
          color: "black", // Change color of x-axis labels
        },
      },
      y: {
        beginAtZero: true,
        ticks: {
          color: "black", // Change color of x-axis labels
        },
      },
    },
    plugins: {
      legend: {
        labels: {
          color: "black", // تعديل لون النص التوضيحي
        },
      },
    },
  },
});

// Data for the profit margin chart
var profitMarginCtx = document
  .getElementById("profitMarginChart")
  .getContext("2d");
var profitMarginChart = new Chart(profitMarginCtx, {
  type: "doughnut",
  data: {
    labels: ["Gross Profit Margin", "Net Profit Margin"],
    datasets: [
      {
        data: [65, 55],
        backgroundColor: ["rgb(133, 73, 4)", "rgba(240, 169, 15, 0.767)"],
      },
    ],
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
      legend: {
        labels: {
          color: "black",
          font: {
            size: 15, // تعديل حجم الخط
          },
        },
      },
    },
  },
});
