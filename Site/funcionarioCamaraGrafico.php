<?php
    require_once 'vendor/autoload.php';

    $funcionarios = Array();

    if(isset($_POST['id'])){
      $id = $_POST['id'];
      $cont = count($id);

      for($i = 0; $i < $cont; $i++)
      {
          $rgf = $id[$i];
          $funcionarioDao = new \App\Model\FuncionarioCamaraDao();
          $funcionarios[$i] = $funcionarioDao->readRgf($rgf);

      }
    }

?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load('current', {'packages':['bar']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ['Nome', 'Total Bruto', 'Total Liquido', 'Total Desconto'],

        <?php
          if($funcionarios != NULL){
            foreach ($funcionarios as $key => $funcionario) {
              foreach ($funcionario as $key => $value) {
        ?>
          ['<?=$value['nome'];?>', <?=$value['tbruto'];?>, <?=$value['tliquido'];?>, <?=-$value['tdesconto'];?>],
        <?php
            }
           }
          }
        ?>

      ]);

      var options = {
          chart: {
            title: 'Funcionários',
            subtitle: 'Compara o Total Bruto, Total Liquido, Total Desconto',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('Grafico'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
</script>
