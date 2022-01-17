<?php

require_once __DIR__ . '/../includes/_header.php';

// this code is responsible for listing the content in admin dash
if ($_GET['type'] == 'key_value_pair' || $_GET['type'] == 'api_key_secret') {
    ob_start();
    header('Location: /admin/meta');
}

if (isset($_GET['role'])) {
    $role = $types['user']['roles'][$_GET['role']] ?? null;
}
?>

<div>
    <?= $admin->get_admin_menu('list', $type, $role['slug'] ?? null); ?>

    <h2 class="mb-4">
        <?php if ($type == 'user'): ?>
        <?= $role['title'] ?>
        <small><i class="fas fa-angle-double-right"></i></small>
        <?php endif ?>

        List of <?= $types[$type]['plural'] ?>
    </h2>

    <form id="dtList" action="/admin/delete-dt-rows" method="post">
        <!-- delete modal -->
        <div id="deleteConfirm" class="modal fade" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Are you sure?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>This will delete <span class="selectedListCount">n</span> item(s)</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                        <button id="deleteSelected" type="submit" class="btn btn-danger"><i class="fas fa-trash-alt mr-2"></i>Delete</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- / delete modal -->
        <!-- duplication modal -->
        <div id="duplicateConfirm" class="modal fade" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Are you sure?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Make a copy <span class="selectedListCount">n</span> item(s)</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success"><i class="fas fa-copy mr-2"></i>Yes, copy</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- / duplication modal -->

        <input type="hidden" name="ids">
        <input type="hidden" name="type" value=<?=$_GET['type']?> >

        <table class="my-4 table table-sm table-striped table-borderless table-hover datatable border-bottom border-light" data-jsonpath="list-json" data-type="<?=$type?>" data-role="<?=$_GET['role'] ?? ''?>">
            <thead class="thead-black">
                <tr>
                    <th scope="col">#</th>
                    <?php
                        $displayed_field_slugs = array();

                        foreach ($types[$type]['modules'] as $i => $module):
                            if (!in_array($module['input_slug'], $displayed_field_slugs)):
                                if (isset($module['list_field']) && $module['list_field']):
                    ?>
                    <th scope="col" class="pl-2"
                        data-orderable="<?=isset($module['list_sortable']) ? $module['list_sortable'] : 'false'?>"
                        data-searchable="<?=isset($module['list_searchable']) ? $module['list_searchable'] : 'false'?>"
                        style="<?=(isset($module['input_primary']) && $module['input_primary']) ? 'max-width:50%' : ''?>">
                        <?=$module['input_slug']?>
                    </th>
                    <?php
                                endif;
                                $displayed_field_slugs[] = $module['input_slug'];
                            endif;
                        endforeach;
                    ?>
                    <th scope="col" data-orderable="false" data-searchable="false"></th>
                </tr>
            </thead>
        </table>
    </form>
</div>

<div id="toast-success" class="admin-toast toast position-fixed bg-dark text-white" role="alert" aria-live="assertive" aria-atomic="true" data-autohide="false">
    <div class="toast-body">
        <span>Changes saved successfully. Refresh to see</span>
        <button type="button" class="ml-2 mb-1 close text-white" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>

<?php require_once __DIR__ . '/../includes/_footer.php';?>
