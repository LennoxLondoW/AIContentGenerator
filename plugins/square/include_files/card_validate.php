<!-- this file is used just to validate user card
prevents scam users from using the sites services 
inlude it where you need card data collection to be used  -->

<!-- first here we load the .env file  -->
<?php
require dirname(__DIR__ . "../") . '/config.php';
if (!$element->page_editable) {
?>


    <!-- end of env  -->
    <div id="_square_" class="square">
        <form id="payment-form">
            <h3 id="card_validate" class="non_ck" <?php $element->is_editable(current_page_table, 's_title', 'text'); ?>><?php echo $s_title; ?></h3>
            <div class="p" <?php $element->is_editable(current_page_table, 's_phrase', 'text'); ?>><?php echo $s_phrase; ?></div>
            <div id="payment-status-container"></div>
            <div id="card-container">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 4335 4335" width="100" height="100">
                    <path fill="#008DD2" d="M3346 1077c41,0 75,34 75,75 0,41 -34,75 -75,75 -41,0 -75,-34 -75,-75 0,-41 34,-75 75,-75zm-1198 -824c193,0 349,156 349,349 0,193 -156,349 -349,349 -193,0 -349,-156 -349,-349 0,-193 156,-349 349,-349zm-1116 546c151,0 274,123 274,274 0,151 -123,274 -274,274 -151,0 -274,-123 -274,-274 0,-151 123,-274 274,-274zm-500 1189c134,0 243,109 243,243 0,134 -109,243 -243,243 -134,0 -243,-109 -243,-243 0,-134 109,-243 243,-243zm500 1223c121,0 218,98 218,218 0,121 -98,218 -218,218 -121,0 -218,-98 -218,-218 0,-121 98,-218 218,-218zm1116 434c110,0 200,89 200,200 0,110 -89,200 -200,200 -110,0 -200,-89 -200,-200 0,-110 89,-200 200,-200zm1145 -434c81,0 147,66 147,147 0,81 -66,147 -147,147 -81,0 -147,-66 -147,-147 0,-81 66,-147 147,-147zm459 -1098c65,0 119,53 119,119 0,65 -53,119 -119,119 -65,0 -119,-53 -119,-119 0,-65 53,-119 119,-119z" />
                </svg>
            </div>
            <button id="_card-button" type="button">Set Payment</button>
        </form>
    </div>


    <!-- place this script tag where you want to load square js bellow jquery file  -->
    <!-- <script>
    if ($('#_square_').attr('id') !== undefined) {
        loadJS(
            $('#base_path').val() + 'plugins/square/index.js',
            (callback = 'loadSDK();'),
            (attributes = {
                type: 'text/javascript',
                async: false
            })
        )
    }
</script> -->
<?php } ?>