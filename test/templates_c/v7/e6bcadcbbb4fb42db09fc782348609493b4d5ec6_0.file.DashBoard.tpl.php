<?php
/* Smarty version 3.1.39, created on 2024-03-14 07:14:45
  from 'C:\xampp\htdocs\innca\layouts\v7\modules\Whatsapp\DashBoard.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_65f2a3e5c2e199_90027304',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e6bcadcbbb4fb42db09fc782348609493b4d5ec6' => 
    array (
      0 => 'C:\\xampp\\htdocs\\innca\\layouts\\v7\\modules\\Whatsapp\\DashBoard.tpl',
      1 => 1710400480,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65f2a3e5c2e199_90027304 (Smarty_Internal_Template $_smarty_tpl) {
?><style>
:root {
  --c1: #007bff;
  --c2: #da39da;
  /* --c1: #da39da; */
}
    .container {
        position: relative;
        padding-top: 5%;
        padding-bottom: 5%;
    }
    .bar {
        position: relative;
        padding-top: 5%;
    }

    .title{
        text-align: center;
        font-weight: bold;
        padding: 3%;
        background-color: var(--c1);
        color: #fff;
        box-shadow: 0 10px 15px 15px rgba(0,0,0,0.05);
        border-radius: 5px;
    }

    .count{
        padding-bottom: 5%;
    }

    h1,h3,h2{
        font-weight: bolder;
    }

    .hl{
        color:var(--c1);
    }
    .sm{
        color: rgba(255, 99, 132, 1);
    }

    .tm{
        color:rgba(54, 162, 235, 1);
    }
    .top{
        padding-top: 5%;
    }

    #submitBtn{
        padding: .8%;
        background-color: var(--c1);
        border: none;
        border-radius: 5px;
        font-weight: bold;
        color: #fff;
    }

    #generateBill{
        margin-top: 5%;
        padding: .8%;
        background-color: var(--c1);
        border: none;
        border-radius: 5px;
        font-weight: bold;
        color: #fff;
        margin-left: 40%;
    }

    #submitBtn:hover, #generateBill:hover, .return:hover{
        opacity: .8;
    }
    .dates{
        padding: 3%;
    }

    #nodata{
        padding: 15px;
    }
    .return{
        position: fixed;
        padding: 1%;
        margin-top: 20px;
        margin-left: 5px;
        background-color: green;
        border: none;
        border-radius: 5px;
        font-weight: bold;
        color: #fff;
    }

</style>

<?php echo '<script'; ?>
 src="https://cdn.jsdelivr.net/npm/sweetalert2@11"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="https://cdn.jsdelivr.net/npm/chart.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="https://cdn.jsdelivr.net/npm/flatpickr"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="https://code.jquery.com/jquery-3.6.0.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="https://cdn.jsdelivr.net/npm/chart.js"><?php echo '</script'; ?>
>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<body>
<button class="return">Return</button>

<div class="container">
<h1 class="title">WhatsApp Dashboard</h1>

<h2 class="text-center top">Generated Reports for <span id="month" class="hl"></span></h2>
    <div class="row">

<div class="dates">
    <div class="col-sm-3 p-2">
      <input type="date" id="fromDate" class="form-control" placeholder="From Date">
    </div>
    <div class="col-sm-3 p-2">
         <input type="date" id="toDate" class="form-control" placeholder="To Date">
    </div>
    <button id="submitBtn" class=" col-sm-3">Find</button>
</div>
<h3 class="text-center" id="nodata"></h3>

    <h3 class="text-cente top">Total number of <span class="sm">Messages Sent :</span> <span id="totalmesages"></span></h3>
    <h3 class="text-cente count">Total number of <span class="tm">Template Messages Sent :</span>  <span id="totaltemplates"></span></h3>




        <div class="chart-container pie col-lg-5">
             <canvas id="pieChart"></canvas>
        </div>
        <div class="chart-container bar col-lg-6">
            <canvas id="barChart"></canvas>
        </div>
    </div>
    <button id="generateBill" class="col-sm-2 mx-auto d-block">Generate bill amount</button>
</div>



<?php echo '<script'; ?>
>
var buttonClicked = false;
$(document).ready(function() {
    function updateCharts(sentMessages, sentTemplates, month, fromDate, toDate) {
        updatePieChart(sentMessages, sentTemplates);
        updateBarChart(sentMessages, sentTemplates);
        const displayedSentMessages = sentMessages !== undefined ? sentMessages : 0;
        const displayedSentTemplates = sentTemplates !== undefined ? sentTemplates : 0;
        if (displayedSentMessages === 0 && displayedSentTemplates === 0) {
            $('#nodata').html("No messages found! within the provided date range. From <span class='hl'>" + fromDate + "</span> To <span class='hl'>" + toDate + "</span>");
        } else {
            $('#nodata').text('');
        }
        $("#totalmesages").text(displayedSentMessages);
        $("#totaltemplates").text(displayedSentTemplates);

        if (buttonClicked) {
        $("#month").html(fromDate + "<span style='color:#000'> to</span> " + toDate);
        } else {
            $("#month").text(month);
        }

    }

    function updatePieChart(sentMessages, sentTemplates) {
        var pieChartCanvas = document.getElementById('pieChart').getContext('2d');
        var pieChartData = {
            datasets: [{
                data: [sentMessages, sentTemplates],
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)'
                ]
            }],
            labels: ['Sent Messages', 'Sent Template Messages']
        };

        if (window.pieChart instanceof Chart) {
            window.pieChart.destroy();
        }

        window.pieChart = new Chart(pieChartCanvas, {
            type: 'pie',
            data: pieChartData,
            options: {}
        });
    }

    function updateBarChart(sentMessages, sentTemplates) {
        var barChartCanvas = document.getElementById('barChart').getContext('2d');
        var barChartData = {
            labels: ['Sent Messages', 'Template Messages'], 
                datasets: [
                    {
                        label: 'Sent Messages',
                        data: [sentMessages, 0], 
                        backgroundColor: 'rgba(255, 99, 132, 1)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Template Messages',
                        data: [0, sentTemplates],
                        backgroundColor: 'rgba(54, 162, 235, 1)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }
                ]
        };
        if (window.barChart instanceof Chart) {
            window.barChart.destroy();
        }

        window.barChart = new Chart(barChartCanvas, {
            type: 'bar',
            data: barChartData,
            options: {}
        });
    }

    function fetchAndUpdateCharts(fromDate, toDate) {
        $.ajax({
            url: 'fetchsentmessage.php',
            type: 'GET',
            data: { fromDate: fromDate, toDate: toDate },
            success: function(response) {
                var data = JSON.parse(response);
                var sentMessages = data.totalSentMessages;

                $.ajax({
                    url: 'fetchsenttemplate.php',
                    type: 'GET',
                    data: { fromDate: fromDate, toDate: toDate },
                    success: function(response) {
                        var data = JSON.parse(response);
                        var sentTemplates = data.totalSentTemplates;
                        var month = data.currentMonth;
                        updateCharts(sentMessages, sentTemplates, month,fromDate,toDate);
                        billing(sentTemplates,sentMessages);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching sent template messages:', error);
                    }
                });
            },
            error: function(xhr, status, error) {
                console.error('Error fetching sent messages:', error);
            }
        });
    }

    $('#submitBtn').click(function() {
        var fromDate = $('#fromDate').val();
        var toDate = $('#toDate').val();
        fetchAndUpdateCharts(fromDate, toDate);
        buttonClicked = true;
    });

    fetchAndUpdateCharts();
});

async function billing(sentTemplates,sentMessages) {
    const generateBillButton = document.getElementById('generateBill');
    generateBillButton.addEventListener('click', function () {
        try {
            const templateMessages = sentTemplates;
            const pricePerTemplateMessage = 0.65;
            const totalOfTemplatemessages = templateMessages * pricePerTemplateMessage

            const basicsentMessages = sentMessages;
            const pricePerSentMessage = 0.30;
            const totalOfSentmessages = basicsentMessages * pricePerSentMessage;
            
            const totalCost = (totalOfTemplatemessages).toFixed(2);
            // const totalCost = (totalOfTemplatemessages + totalOfSentmessages).toFixed(2);

            if(isNaN(totalCost)){
                Swal.fire({
                    title: 'Please generate the stats before generating bill amount', 
                    icon: 'error',
                });
            }else{
                Swal.fire({
                    title: 'Total cost: Rs. ' + totalCost,
                    text: 'Billing Amount ',
                    icon: 'success'
                });    
            }
            
        } catch (error) {
            console.error('Error generating bill:', error);
        }
    });
}

document.addEventListener('DOMContentLoaded', function () {
    flatpickr("#fromDate", {
        dateFormat: "Y-m-d",
        onChange: function(selectedDates, dateStr, instance) {
            toDateCalendar.set("minDate", dateStr);
        }
    });
    const toDateCalendar = flatpickr("#toDate", {
        dateFormat: "Y-m-d"
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const returnButton = document.querySelector('.return');
    returnButton.addEventListener('click', function() {
        const currentUrl = window.location.href;
        const domain = window.location.origin;
        const returnUrl = domain + '/innca/index.php';
        window.location.href = returnUrl;
    });
});

<?php echo '</script'; ?>
>
</body>
<?php }
}
