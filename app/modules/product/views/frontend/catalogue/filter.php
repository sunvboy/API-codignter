<?php

$catalogueid = $detailCatalogue['id'];
$detailCatalogue = $this->Autoload_Model->_get_where(array(
    'select' => 'id, attrid',
    'table' => 'product_catalogue',
    'where' => array('id' => $catalogueid),
));
$attribute_catalogue = getListAttr($detailCatalogue['attrid']);
?>
<div class="module">
    <h3 class="modtitle">Filter </h3>

    <div class="modcontent ">
        <form class="type_2">

            <div class="table_layout filter-shopby">
                <div class="table_row">
                    <div class="table_cell" style="z-index: 103;">
                        <legend>Search</legend>
                        <input class="form-control keyword filter" type="text" value="" size="50" autocomplete="off"
                               placeholder="Search" name="keyword">
                    </div>

                    <?php if (check_array($attribute_catalogue)) {
                        foreach ($attribute_catalogue as $key => $val) { ?>

                            <div class="table_cell">
                                <fieldset>
                                    <legend><?php echo $key ?></legend>
                                    <ul class="checkboxes_list" id="choose_attr">
                                        <input type="text" class="hidden filter" name="attr" value="">
                                        <?php if (check_array($val)) {
                                            foreach ($val as $sub => $subs) {
                                                if ($sub != 'keyword_cata') {
                                                    ?>
                                                    <li data-keyword="<?php echo $val['keyword_cata'] ?>" class="attr">
                                                        <input class="checkbox-item filter" type="checkbox"
                                                               name="attr[]" value="<?php echo $sub ?>"
                                                               id="category_<?php echo $sub ?>">
                                                        <label class="label-checkboxitem"
                                                               for="category_<?php echo $sub ?>"><?php echo $subs ?></label>
                                                    </li>
                                                <?php }
                                            }
                                        } ?>


                                    </ul>

                                </fieldset>

                            </div>
                        <?php } ?>
                    <?php } ?>


                    <script>
                        $(document).on('change', '.attr', function () {
                            if ($(this).find('input[name="attr[]"]:checked').length) {
                                $(this).find('input[name="attr[]"]').prop('checked', false);
                                $(this).find('.label-checkboxitem').removeClass('checked');
                            } else {
                                $(this).find('input[name="attr[]"]').prop('checked', true);
                                $(this).find('.label-checkboxitem').addClass('checked');
                            }
                            let attr = '';
                            $('#choose_attr').find('.form-control').html('');
                            $('input[name="attr[]"]:checked').each(function (key, index) {
                                let id = $(this).val();
                                let attr_id = $(this).parents('li').attr('data-keyword');
                                attr = attr + attr_id + ';' + id + ';';
                            });
                            if (attr == '') {
                                $('#choose_attr').find('.form-control').html('<span>Chọn thuộc tính</span>');
                            }
                            $('#choose_attr > input').val(attr).change();
                        });
                        $(document).on('change', '.filter', function () {
                            let page = $('.pagination .active a').text();
                            time = setTimeout(function () {
                                get_list_object(page);
                            }, 500);
                            return false;
                        });
                        $(document).on('click', '.pagination li a', function () {
                            let _this = $(this);
                            let page = _this.attr('data-ci-pagination-page');
                            time = setTimeout(function () {
                                get_list_object(page);
                            }, 500);
                            return false;
                        });
                        function get_list_object(page = 1) {
                            let attr = $('input[name="attr"]').val();
                            let param = {
                                'page': page,
                                'perpage': 20,
                                'catalogueid': <?php echo $detailCatalogue['id']?>,
                                'attr': attr,
                            };
                            let ajaxUrl = 'product/ajax/frontend/filter';
                            $.get(ajaxUrl, {
                                    perpage: param.perpage,
                                    page: param.page,
                                    catalogueid: param.catalogueid,

                                    attr: param.attr,
                                },
                                function (data) {
                                    let json = JSON.parse(data);
                                    $('#ajax-content').html(json.html);
                                    $('#pagination').html(json.pagination);
                                });
                        }
                    </script>


                </div>

            </div>


        </form>
    </div>

</div>