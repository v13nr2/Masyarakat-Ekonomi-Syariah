 
<script>

    var base_url = "<?= base_url(); ?>";
    $(document).ready(function () {
        // Autocomplete Typeahead
        var dataMenu = $.ajax({type: "GET", url: base_url + "acl/search_menu", async: false}).responseText;
        
        var $input = $(".typeaheadMenu");
        $input.typeahead({
            source: JSON.parse(dataMenu),
            displayText: function (item) {
                return item.name
            },
            updater: function (item) {
                /* navigate to the selected item */
                window.location.href = base_url + item.url;
            }
        });
    })

</script>

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$ci = & get_instance();

$menu_a = $this->uri->segment(1);
$menu_b = $this->uri->segment(2);
$menu_c = $this->uri->segment(3);
?>
<script>

</script>

<div id="sidebar-menu"	class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <aside class="main-sidebar">
            <section class="sidebar">
                <input type="text" id="searchMenu" class="form-control typeaheadMenu" placeholder="Search..." data-provide="typeahead" autocomplete="off">

                <ul  class="nav side-menu" style="width: 230px; height:500px; overflow: auto">

                    <?php
                    $this->load->model('model_modul');
                    echo $ci->model_modul->get_parent();
                    //echo $this->db->last_query();
                    //die();
                    ?>

                </ul>
            </section>
        </aside>
    </div>
</div>


