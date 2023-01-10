<?php
// this ensures admin can manage the square data 
//save data to .env
if (isset($_POST['update_env'])) {
    $env = __DIR__ . "/.env";
    file_put_contents($env, '
# Must match the values found in the corresponding production or sandbox environment
# Acceptable values are sandbox or production

# square running environment
ENVIRONMENT=' . $ENVIRONMENT . '

# your application ID
SQUARE_APPLICATION_ID=' . $SQUARE_APPLICATION_ID . '

# your access token 
SQUARE_ACCESS_TOKEN=' . $SQUARE_ACCESS_TOKEN . '

# your location ID
SQUARE_LOCATION_ID=' . $SQUARE_LOCATION_ID . '
   ');

    echo "<div style='color:green; text-align:center; margin:20px auto;'>File updated successfully</div>";
}
if ($element->page_editable) {
    echo '
    <div class="multiline" style="text-align:left;">
    <h4 style="text-align:center; font-weight:bold;">Current environment variables</h4>
    <div style="border-radius:5px; border: solid .25px rgba(0,0,0,.2); padding:5px;">'.file_get_contents(__DIR__ . "/.env").'</div>
    </div>
    
    ';
?>
    <div class="edit_div">
        <table>
            <caption>
                <h3>Edit your environment variables</h3>
            </caption>
            <thead>
                <tr>
                    <th>Object</th>
                    <th>Data</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>ENVIRONMENT <br>( either productio or sandbox ) </td>
                    <td><span class="non_ck" <?php $element->is_editable(current_page_table, 'ENVIRONMENT', 'text'); ?>><?php echo $ENVIRONMENT; ?></span></td>
                </tr>
                <tr>
                    <td>SQUARE_APPLICATION_ID</td>
                    <td><span class="non_ck" <?php $element->is_editable(current_page_table, 'SQUARE_APPLICATION_ID', 'text'); ?>><?php echo $SQUARE_APPLICATION_ID; ?></span></td>
                </tr>
                <tr>
                    <td>SQUARE_ACCESS_TOKEN</td>
                    <td><span class="non_ck" <?php $element->is_editable(current_page_table, 'SQUARE_ACCESS_TOKEN', 'text'); ?>><?php echo $SQUARE_ACCESS_TOKEN; ?></span></td>
                </tr>
                <tr>
                    <td>SQUARE_LOCATION_ID</td>
                    <td><span class="non_ck" <?php $element->is_editable(current_page_table, 'SQUARE_LOCATION_ID', 'text'); ?>><?php echo $SQUARE_LOCATION_ID; ?></span></td>
                </tr>
                <tr>
                    <td>PUBLISH<br> <b>please rember to publish to update .env file</b></td>
                    <td>
                        <form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post">
                            <button name="update_env" style="background-color: var(--site-primary-color); color:var(--site-tertiary-color); padding: 15px;" type="submit">publish</button>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
       
    </div>


<?php
    //pick email settings from table
}
?>