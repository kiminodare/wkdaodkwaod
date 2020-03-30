<?php
use secure\Secure;
use export\ExportData;
use export\ExportDataExcel;
use export\ExportDataCSV;
use export\ExportDataTSV;
use phpformbuilder\database\Mysql;
use phpformbuilder\database\Pagination;

session_start();
include_once '../../conf/conf.php';
include_once ADMIN_DIR . 'secure/class/secure/Secure.php';
include_once ADMIN_DIR . 'class/export/ExportData.php';

// lock page
Secure::lock();

if (!isset($_GET['table']) || !isset($_GET['format']) || !preg_match('`excel|csv|tsv|browser`', $_GET['format']) || !isset($_GET['npp']) || !is_numeric($_GET['npp']) || (isset($_GET['p']) && !is_numeric($_GET['p']))) {
    exit();
}
$npp = $_GET['npp'];
if ($_GET['npp'] < 0) {
    $npp = 100000;
}
$table = addslashes($_GET['table']);
$format = $_GET['format'];
if (!isset($_SESSION['export'][$table]['sql'])) {
    exit();
}
$db = new Pagination();
$columns = $db->getColumnNames($table);
$db->pagine($_SESSION['export'][$table]['sql'], $npp, 'p', '', 1, false, '/', '');
$nbre = $db->rowCount();
if (!empty($nbre)) {
    if ($format == 'browser') {
        $output = array(
            'thead' => $columns,
            'rows'  => array()
        );
        $i = 0;
        while (! $db->endOfSeek()) {
            $row = $db->row();
            foreach ($columns as $column_name) {
                $output['rows'][$i][] = $row->$column_name;
            }
            $i ++;
        }
        $thead = '<thead><tr><th>' . implode('</th><th>', $output['thead']) . '</th></tr></thead>';
        $tbody = '<tbody>' . array_reduce($output['rows'], function ($a, $b) {
            return $a .= '<tr><td>' . implode('</td><td>', $b) . '</td></tr>';
        }) . '</tbody>';
    } else {
        if ($format == 'excel') {
            $exporter = new ExportDataExcel('browser', $table . '.xls');
        } elseif ($format == 'csv') {
            $exporter = new ExportDataCSV('browser', $table . '.csv');
        } elseif ($format == 'tsv') {
            $exporter = new ExportDataTSV('browser', $table . '.tsv');
        }
        $exporter->initialize();
        $exporter->addRow($columns);
        while (! $db->endOfSeek()) {
            $result = array();
            $row = $db->row();
            foreach ($columns as $column_name) {
                $result[] = $row->$column_name;
            }
            $exporter->addRow($result);
        }
        $exporter->finalize();
        exit();
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Gilles Migliori">
    <link rel="icon" href="/favicon.ico">

    <link rel="stylesheet" href="<?php echo ADMIN_URL; ?>assets/stylesheets/jquery.dataTables.min.css">

    <style>
        body {
            margin: 0;
            padding: 0 5vw;
            font-size: 12pt;
        }
        @media only screen {
            * {
                box-sizing: border-box;
            }
            html, body {
                width: 100vw;
                height: 100vh;
            }
            body {
                margin: 0;
                padding: 0 5vw;
                font-size: 12px;
            }
            .dt-buttons {
                padding: 2rem;
                text-align: center;
            }
            .dt-button {
                font-size: 1.5rem;
                text-transform: lowercase;
                font-variant: small-caps;
                font-weight: normal;
                background-color: #2196f3;
                color: white;
                border-color: #2196f3;
                border-style: inherit;
                padding: .5rem 2.5rem;
                cursor: pointer;
            }
            .dt-button:hover {
                background-color: #155B94;
                border-color: #155B94;
            }
        }
    </style>
</head>
<body>
    <?php echo '<table id="example" class="display compact" style="width:100%">' . $thead . $tbody . '</table>'; ?>
    <script type="text/javascript" src="<?php echo ADMIN_URL; ?>assets/javascripts/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="<?php echo ADMIN_URL; ?>assets/javascripts/plugins/datatables/jquery.dataTables.js"></script>
    <script type="text/javascript" src="<?php echo ADMIN_URL; ?>assets/javascripts/plugins/datatables/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="<?php echo ADMIN_URL; ?>assets/javascripts/plugins/datatables/buttons.print.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#example').DataTable( {
                dom: 'Bfrtip',
                paging: false,
                ordering:  false,
                searching: false,
                scrollX: '90vw',
                scrollY: 'calc(90vh - 110px)',
                buttons: [
                    'print'
                ]
            } );
        } );
    </script>
</body>
</html>
