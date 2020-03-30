<?php
use generator\TemplatesUtilities;

include_once GENERATOR_DIR . 'class/generator/TemplatesUtilities.php';

$generator = $_SESSION['generator'];

// look for nested table
$has_nested         = false;
$nested_elements    = '';
$nested_table_class = '';
$nested_table_data = '';
for ($i=0; $i < $generator->columns_count; $i++) {
    if ($generator->columns['nested'][$i] == true) {
        $has_nested = true;
        $nested_table_class = ' table-togglable';
        $nested_table_data = ' data-toggle-column="first" data-toggle-selector=".footable-toggle"';
    }
}
?>
    <div class="card {{ constant('DEFAULT_CARD_CLASS') }} mr-4">
        <div class="card-header d-lg-flex flex-wrap justify-content-between {{ constant('DEFAULT_CARD_HEADING_CLASS') }}">
            {% if object.records_count > 0 %}

            <div class="d-flex ml-auto order-lg-2">
                {{ object.select_number_per_page|raw }}
            </div>

            <hr class="w-100 d-lg-none">

            {% endif %}
            <div class="d-flex order-lg-0 mb-3 mb-sm-0">
                {% if object.can_create == true %}
                <a href="{{ constant('ADMIN_URL') }}{{ object.item }}/create" class="btn btn-sm mr-1 btn-primary d-flex align-items-center legitRipple"><i class="{{ constant('ICON_PLUS') }} position-left"></i>{{ constant('ADD_NEW') }}</a>
                {% endif %}
<?php
// when building users & profiles templates, $_POST['export_btn'] is not set
if (!isset($_POST['rp_export_btn']) || ($_POST['rp_export_btn'] == true)) {
?>
                {% if object.records_count > 0 %}
                {{ object.export_data_button|raw }}
                {% endif %}
<?php } ?>
            </div>

            <div class="order-lg-1 mx-lg-auto">
                <form name="rp-search-form" id="rp-search-form" action="" class="form-inline justify-content-center">
                    <div class="form-group">
                        <div class="input-group">
                            <div id="rp-search-field" class="dropdown input-group-prepend">
                                <a class="dropdown-toggle pl-4 pr-3 rounded-left border-left border-top border-bottom" id="search-dropdown-link" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false"></a>
                                <div class="dropdown-menu" aria-labelledby="search-dropdown-link">
                                    {% for field_name, field_display_name in object.fields %}
                                    {% set active = '' %}
                                    {% if field_name == attribute(session.rp_search_field, object.table) %}
                                    {% set active = ' active' %}
                                    {% endif %}
                                    <a class="dropdown-item{{ active }}" href="#" data-value="{{ field_name }}">{{ field_display_name }}</a>
                                    {% endfor %}
                                </div>
                            </div>
                            {% set search_value = '' %}
                            {% if attribute(session.rp_search_string, object.table) is defined %}
                            {% set search_value = attribute(session.rp_search_string, object.table) %}
                            {% endif %}
                            <input id="rp-search" name="rp-search" type="text" value="{{ search_value }}" placeholder="{{ constant('SEARCH') }}" class="form-control flex-grow-1">
                            <div class="input-group-append">
                                <button id="rp-search-submit" class="btn btn-secondary ladda-button" data-style="zoom-in" type="submit"><span class="ladda-label"><i class="{{ constant('ICON_SEARCH') }}"></i></span></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>

        {# Partial block list - rendered alone on the research results #}
        {% block object_list %}

        <div id="{{ object.item }}-list">

        {% if object.records_count > 0 %}

            <div class="table-responsive">
                <table class="table table-striped table-condensed table-data<?php echo $nested_table_class; ?>"<?php echo $nested_table_data ?>>
                    <thead>
                        <tr class="{{ constant('DEFAULT_TABLE_HEADING_BACKGROUND') }}">
<?php
if ($has_nested == true) { ?>
                            <th>&nbsp;</th>
<?php
} // END if
?>
                            {% if constant('ADMIN_ACTION_BUTTONS_POSITION') == 'left' %}
                            <th>{{ constant('ACTION_CONST') }}</th>
                            {% endif %}

<?php
for ($i=0; $i < $generator->columns_count; $i++) {
    if ($generator->columns['skip'][$i] == false) {
        $field_name = $generator->columns['name'][$i];
        if ($generator->columns['sorting'][$i] == true && $generator->columns['nested'][$i] !== true) {
            /* get sorting field (may be relation) */

            // default without relation
            $data_field = $field_name;
            $relation = $generator->columns['relation'][$i];
            if (!empty($relation['target_table'])) {
                //sorting relation
                $data_field = array();
                $target_fields = explode(', ', $relation['target_fields']);
                foreach ($target_fields as $tf) {
                    $data_field[] = $relation['target_table'] . '.' . $tf;
                }
                $data_field = implode(', ', $data_field);
            }
?>
                            <th class="sorting">{{ object.fields.<?php echo $field_name; ?> }}<a href="#" class="sorting-up" data-field="<?php echo $data_field; ?>" data-direction="ASC"><i class="{{ constant('ICON_ARROW_UP') }}"></i></a><a href="#" class="sorting-down" data-field="<?php echo $data_field; ?>" data-direction="DESC"><i class="{{ constant('ICON_ARROW_DOWN') }}"></i></a></th>
<?php
        } else {
            // Footable plugin groups & hide hidden fields
            // Field with 'data-toggle="true"' will have a '+' sign to expand hidden fields.
            $footable_data = '';
            if ($generator->columns['nested'][$i] === true) {
                $footable_data = ' data-breakpoints="all"';
            }
?>
                            <th<?php echo $footable_data; ?>>{{ object.fields.<?php echo $field_name; ?> }}</th>
<?php
        } // END else
    } // END if !skip
} // END for

// External relations
if (count($generator->external_columns) > 0) {
    foreach ($generator->external_columns as $key => $ext_col) {
        if ($ext_col['active'] === true) { ?>
                            <th><?php echo $ext_col['table_label']; ?></th>
<?php
        } // end if
    } // END foreach
} // END if
if (isset($_POST['rp_open_url_btn']) && ($_POST['rp_open_url_btn'] == true)) { ?>
                            <th>{{ constant('DISPLAY') }}</th>
<?php
} // END if ?>
                        {% if constant('ADMIN_ACTION_BUTTONS_POSITION') == 'right' %}
                            <th>{{ constant('ACTION_CONST') }}</th>
                        {% endif %}
                        </tr>
                    </thead>
                    <tbody>
                    {% for i in range(0, object.records_count - 1) %}
                        <tr>
<?php
if ($has_nested == true) { ?>
                            <td></td>
<?php
} // END if
?>
                            {% if constant('ADMIN_ACTION_BUTTONS_POSITION') == 'left' %}
                            <td class="has-btn-group no-ellipsis">
                                <div class="btn-group">
                                    {% if object.pk[loop.index0] in object.authorized_update_pk %}
                                    <a href="{{ constant('ADMIN_URL') }}{{ object.item }}/edit/{{ object.pk[loop.index0] }}" class="btn btn-sm btn-warning legitRipple" data-tooltip="{{ constant('EDIT') }}" data-delay="500"><span class="{{ constant('ICON_EDIT') }} icon-md"></span></a>
                                    {% endif %}
                                    {% if object.can_create == true %}
                                    <a href="{{ constant('ADMIN_URL') }}{{ object.item }}/delete/{{ object.pk[loop.index0] }}" class="btn btn-sm btn-danger legitRipple" data-tooltip="{{ constant('DELETE_CONST') }}" data-delay="500"><span class="{{ constant('ICON_DELETE') }} icon-md"></span></a>
                                    {% endif %}
                                </div>
                            </td>
                            {% endif %}
<?php
for ($i=0; $i < $generator->columns_count; $i++) {
    if ($generator->columns['skip'][$i] == false) {
        $field_name = $generator->columns['name'][$i];

        // get display value
        $display_value = TemplatesUtilities::getDisplayValue($generator, $field_name, $i);

        if (!empty($generator->columns['jedit'][$i])) { // with jedit
            echo TemplatesUtilities::getJeditCell($generator, $field_name, $display_value, $i);
        } else { // without jedit ?>
                        <td><?php echo $display_value; ?></td>
<?php
        } // END without jedit
    } // END if !skip
} // END for
// External relations
if (count($generator->external_columns) > 0) {
    // nested table with external data
    $uniqId = uniqid();
?>
                            {% if object.external_tables_count > 0 %}
                            {% for j in range(0, object.external_tables_count - 1) %}
                            <td class="no-ellipsis">
                                {% if object.external_rows_count[i][j] > 0 %}
                                <h6 class="card-title text-center text-nowrap mb-2"><span class="badge bg-gray-300 position-left">{{ object.external_rows_count[i][j] }}</span><a class="dropdown-toggle" data-toggle="collapse" href="#{{ object.external_fields[i][j]['uniqid'] }}" role="button" aria-expanded="false" aria-controls="{{ object.external_fields[i][j]['uniqid'] }}"><small class="text-muted nowrap">{{ constant('SHOW') }} / {{ constant('HIDE') }}</small></a></h6>
                                <div class="collapse" id="{{ object.external_fields[i][j]['uniqid'] }}">
                                {{ object.external_add_btn[i][j]|raw }}
                                    <table class="table table-striped table-condensed">
                                        <thead class=" {{ constant('DEFAULT_TABLE_HEADING_BACKGROUND') }}">
                                            <tr>
                                                {% for field, value in object.external_fields[i][j].fieldnames %}
                                                <th>{{ value }}</th>
                                                {% endfor %}
                                            </tr>
                                        </thead>
                                        <tbody>

                                            {# Loop records #}

                                            {% for k in range(0, object.external_rows_count[i][j] - 1) %}
                                            <tr>

                                                {# Loop fields #}

                                                {% for field, value in object.external_fields[i][j].fields %}
                                                <td>{{ object.external_fields[i][j].fields[field][k]|raw }}</td>
                                                {% endfor %}
                                            </tr>
                                            {% endfor %}
                                        </tbody>
                                    </table>
                                </div>
                                {% else %}
                                {{ object.external_add_btn[i][j]|raw }}
                                {% endif %}
                            </td>
                            {% endfor %}
                            {% endif %}
<?php
} // END if
if (isset($_POST['rp_open_url_btn']) && ($_POST['rp_open_url_btn'] == true)) { ?>
                            <td><a href="{{ constant('BASE_URL') }}" data-delay="500" data-tooltip="{{ constant('OPEN_URL') }}" target="_blank"><span class="{{ constant('ICON_NEW_TAB') }} text-center"></span></a></td>
<?php
} // END if ?>
                            {% if constant('ADMIN_ACTION_BUTTONS_POSITION') == 'right' %}
                            <td class="has-btn-group no-ellipsis">
                                <div class="btn-group">
                                    {% if object.pk[loop.index0] in object.authorized_update_pk %}
                                    <a href="{{ constant('ADMIN_URL') }}{{ object.item }}/edit/{{ object.pk[loop.index0] }}" class="btn btn-sm btn-warning legitRipple" data-tooltip="{{ constant('EDIT') }}" data-delay="500"><span class="{{ constant('ICON_EDIT') }} icon-md"></span></a>
                                    {% endif %}
                                    {% if object.can_create == true %}
                                    <a href="{{ constant('ADMIN_URL') }}{{ object.item }}/delete/{{ object.pk[loop.index0] }}" class="btn btn-sm btn-danger legitRipple" data-tooltip="{{ constant('DELETE_CONST') }}" data-delay="500"><span class="{{ constant('ICON_DELETE') }} icon-md"></span></a>
                                {% endif %}
                                </div>
                            </td>
                            {% endif %}
                        </tr>
                        {% endfor %}
                    </tbody>
                </table>
            </div> <!-- END table-responsive -->

            {% else %}
            <div class="card-body">
                <p class="text-semibold">
                    {{ alert(constant('NO_RECORD_FOUND'), 'alert-info has-icon')|raw }}
                </p>
            </div>
            {% endif %}

            <div class="card-footer  {{ constant('DEFAULT_CARD_FOOTER_CLASS') }} p-4 mt-5">
                {{ object.pagination_html|raw }}
            </div>
        </div> <!-- END {{ object.item }}-list -->

        {% endblock object_list %}
        {# END Partial block - rendered alone on the research results #}

    </div> <!-- END card -->
