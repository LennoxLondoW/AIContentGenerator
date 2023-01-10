<?php
session_start();
require_once '../controlers/adminControler.php';
require_once '../blades/header.php';
?>
<style>
 
</style>
<div id="bottom2" class="container">
    <div class="wrapper">
        <div class="btm2_con">
            <div style="width:800px; max-width:96%; margin: 30px auto;">
                <div class="widget-container classic-textwidget custom-classic-textwidget">
                    <div class="classic-text-widget">
                        <h2 class="admin_table_h2">View or Customize pages</h2>
                        <br>

                        <div class="admin_table">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Page</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach (glob("*.php") as $file) {
                                        $name = ucfirst(str_replace(".php", "", basename($file)));
                                        echo "<tr>
                                                <td><a href='" . base_path . $name . "'>" . $name . "</a></td>
                                                <td><a class='non_spa danger' href='" . base_path . $name . "/edit/true'>edit</a></td>
                                             </tr>";
                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<?php
require_once '../blades/footer.php';
?>