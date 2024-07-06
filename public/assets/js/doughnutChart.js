
// Data for the profit margin chart
var grossProfit;

if (profits.net === 0) {
    grossProfit = 0;
} else {
    grossProfit = 100 - profits.net;
}
var netProfit = profits.net;


var profitMarginCtx = document.getElementById("profitMarginChart").getContext("2d");
if (grossProfit === 0 && netProfit === 0) {
    var profitMarginChart = new Chart(profitMarginCtx, {
        type: "doughnut",
        data: {
            labels: ["Gross Profit Margin", "Net Profit Margin"],
            datasets: [
                {
                    data: [1],
                    backgroundColor: ["gray"],
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false,
                },
                tooltip: {
                    enabled: false,
                },
            },
        },
    });
}
else {
    var profitMarginChart = new Chart(profitMarginCtx, {
        type: "doughnut",
        data: {
            labels: ["Gross Profit Margin", "Net Profit Margin"],
            datasets: [
                {
                    data: [grossProfit, netProfit],
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
                            size: 15,
                        },
                    },
                },
            },
        },
    });
}

