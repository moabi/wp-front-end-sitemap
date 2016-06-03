<div class="wrap">

    <h2>Front-end Sitemap</h2>
<table>
    <tr>
        <td>Functions</td>
        <td>Create a list of pages, cache it</td>
    </tr>
    <tr>
        <td>USE : </td>
        <td><input style="width: 320px" type="text" readonly value='[frontend-sitemap type="page" class="your-wrapper-class"]' /></td>
    </tr>
</table>



    <form method="post" action="options.php">

        <?php settings_fields( 'fes8x-settings-group' ); ?>
        <?php do_settings_sections( 'fes8x-settings-group' ); ?>
        <table class="form-table">
            <tr>
                <th scope="row">Options :</th>
            </tr>

            <tr>
                <td>
                    <label for="excluded_pages">Excluded pages : <br />
                        <em>
                            (ID, integers only, comma separated)
                        </em></label>
                </td>
                <td>
                    <input placeholder="2,10,446" id="excluded_pages" type="text" name="excluded_pages" value="<?php echo get_option('excluded_pages'); ?>">
                </td>
            </tr>

        </table>
        <table>
            <tr>
                <td>
                    <?php submit_button(); ?>
                </td>
            </tr>
        </table>


    </form>


</div>

