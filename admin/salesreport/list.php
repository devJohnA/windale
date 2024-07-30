<style>
 @media print {
        body * {
            visibility: hidden;
        }
        #reportContent,
        #reportContent * {
            visibility: visible;
        }
        #reportContent {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            padding-left: 6mm;
            padding-right: 6mm;
            box-sizing: border-box;
        }
        @page {
            size: auto;
            margin: 0mm 6mm; /* This sets top/bottom margins to 0 and left/right to 6mm */
        }
    }
</style>
<h2 class="text-center mb-4">Sales Report</h2>

<div class="row justify-content-center mb-4">
    <div class="col-md-3">
        <label for="dateFrom">From:</label>
        <input type="date" id="dateFrom" class="form-control">
    </div>
    <div class="col-md-3">
        <label for="dateTo">To:</label>
        <input type="date" id="dateTo" class="form-control">
    </div>
    <div class="col-md-2 d-flex align-items-end">
        <button id="generateReport" class="btn btn-primary">Generate Report</button>
    </div>
</div>

<div id="reportContent">
    <p class="text-center alert alert-secondary text-dark">Set date to view sales report</p>
</div>
<div class="row mb-4">
    <div class="col-md-12 text-start"> 
        <button onclick="window.print();" class="btn btn-primary">Print Sales Report</button>
    </div>
</div>
<script>
    document.getElementById('generateReport').addEventListener('click', function() {
    var dateFrom = document.getElementById('dateFrom').value;
    var dateTo = document.getElementById('dateTo').value;

    if (dateFrom && dateTo) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'generate_report.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                document.getElementById('reportContent').innerHTML = xhr.responseText;
            }
        };
        xhr.send('dateFrom=' + dateFrom + '&dateTo=' + dateTo);
    } else {
        alert('Please select both dates.');
    }
});
</script>
