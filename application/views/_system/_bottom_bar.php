<br/>
<style type="text/css">
    div.exec-container{
        position: fixed;
        padding: 5px 10px;
        border-top: 1px solid rgba(131, 132, 134, 0.3);
        background-color: #ECF0F5;
        width: 100%;
        bottom: 0px;
        text-align: right;
    }
</style>
<div class="exec-container">
    <!--    START: {START} <br/>
        END: {END} <br/>-->
    Page Load in <strong> {elapsed_time} ms</strong> & execute <strong><a href="#" data-toggle="modal" data-target="#exec-modal"><?=count($query)?> query(s)</a></strong>
</div>
<div class="modal fade" id="exec-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">List Executed Query</h4>
      </div>
      <div class="modal-body">
        <ol>
        <?php
        foreach ($query as $key => $value) {
            echo "<li><strong>SQL</strong> : $value[query]<br /><strong>Data Bind</strong> : ".json_encode($value['bindings'])."<br /><strong>Time</strong> : $value[time]</li>";
        }
        ?>
        </ol>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
