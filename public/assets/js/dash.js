const ctx = document.getElementById("myChart").getContext("2d");
const myChart = new Chart(ctx, {
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
        borderWidth: 3,
        pointBackgroundColor: "rgb(133, 73, 4)",
        pointBorderColor: "rgb(133, 73, 4)",
        pointHoverBackgroundColor: "rgb(133, 73, 4)",
        pointHoverBorderColor: "rgb(133, 73, 4)",
      },
      {
        label: "Profit",
        data: [30, 20, 40, 30, 50, 40, 60, 50, 70, 60, 80, 70],
        borderColor: "rgba(240, 169, 15, 0.767)",
        borderWidth: 3,
        pointBackgroundColor: "rgba(240, 169, 15, 0.767)",
        pointBorderColor: "rgba(240, 169, 15, 0.767)",
        pointHoverBackgroundColor: "rgba(240, 169, 15, 0.767)",
        pointHoverBorderColor: "rgba(240, 169, 15, 0.767)",
      },
      {
        label: "Profit",
        data: [20, 10, 30, 20, 40, 30, 50, 40, 60, 60, 80, 70],
        borderColor: "white",
        borderWidth: 3,
        pointBackgroundColor: "white",
        pointBorderColor: "#fff",
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
          color: "black",
          font: {
            weight: "800",
          },
        },
      },
      y: {
        beginAtZero: true,
        ticks: {
          color: "black",
          font: {
            weight: "800",
          }, // Change color of x-axis labels
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
