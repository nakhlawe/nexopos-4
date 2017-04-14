<div class="nav-tabs-custom variation-{{ variation_id }}" ng-repeat="(variation_id, variation) in item.variations">

    <ul class="nav nav-tabs variation-header-{{ variation_id }}">

        <li
            ng-repeat="(variation_tab_id, variation_tab ) in variation.tabs"
            ng-hide="variation_tab.hide( item )"
            class="{{ tabContentIsActive( variation_tab.active ) ? 'active' : '' }} variation-{{ variation_id }}-tab-header-{{ variation_tab_id }}"
        ><a href="javascript:void(0)" ng-click="activeTab( $event, variation_id, variation_tab_id )">{{ variation_tab.title }} <span class="badge badge-warning" ng-show="countAllErrors( variation_tab ) > 0">{{ countAllErrors( variation_tab ) }}</span></a></li>

        <li
            class="pull-right"
            ng-hide="item.selectedType.disableVariation"
            >
            <span
                ng-show="item.variations.length > 1"
                title="<?php echo __( 'Supprimer une variation', 'nexo' );?>"
                class="btn btn-danger btn-md"
                ng-click="removeVariation( variation_id )">
                    <i class="fa fa-remove"></i>
            </span>

            <span
                title="<?php echo __( 'Ajouter une variation', 'nexo' );?>"
                class="btn btn-info btn-md"
                ng-click="addVariation()">
                    <i class="fa fa-plus"></i>
            </span>
        </li>

    </ul>

    <div class="tab-content variation-body-{{ variation_id }}">

      <div
        ng-repeat="(variation_tab_id, variation_tab ) in variation.tabs"
        ng-init="variation.tabs[0].active   =   tabContentIsActive( variation.tabs[0].active, variation_tab_id )"
        class="variation-{{ variation_id }}-tab-body-{{ variation_tab_id }}"
        style="display:block;">

        <div ng-show="variation_tab.active"
        class="tab-pane row">

            <div
                ng-repeat="field in itemsAdvancedFields[ variation_tab.namespace ]"
                class="{{ field.class !== undefined ? field.class : 'col-lg-6 col-sm-6 col-xs-12' }}"
                ng-show="field.show( variation_tab, item, itemsAdvancedFields[ variation_tab.namespace ] )"
                >

                <div class="form-group" ng-if="field.type == 'text'">
                    <div class="input-group">
                      <span class="input-group-addon">{{ field.label }}</span>
                      <input
                        type="text"
                        class="form-control"
                        ng-model="variation_tab.models[ field.model ]"
                        placeholder="{{ field.placeholder }}"
                        ng-blur="validate.blur( field, variation_tab, {
                            variation_id        :  variation_id,
                            variation_tab_id    :   variation_tab_id
                        })"
                        ng-focus="validate.focus( field, variation_tab, {
                            variation_id        :  variation_id,
                            variation_tab_id    :   variation_tab_id
                        })"
                        >
                        <span ng-show="field.addon" class="input-group-addon">{{ field.addon }}</span>
                    </div>
                    <p class="help-block {{ field.model }}-helper" style="height:30px;font-size:12px;">{{ field.desc }}</p>
                </div>

                <div class="form-group" ng-if="field.type == 'select'">
                    <div class="input-group">
                        <span class="input-group-addon">{{ field.label }}</span>
                        <select
                            class="form-control"
                            ng-model="variation_tab.models[ field.model ]"
                            ng-blur="validate.blur( field, variation_tab, {
                                variation_id        :  variation_id,
                                variation_tab_id    :   variation_tab_id
                            })"
                            ng-focus="validate.focus( field, variation_tab, {
                                variation_id        :  variation_id,
                                variation_tab_id    :   variation_tab_id
                            })"
                        >
                            <option ng-repeat="option in field.options" value="{{ option.value }}">{{ option.label }}</option>
                        </select>
                        <span class="input-group-btn" ng-if="field.buttons.length > 0">
                            <button class="btn btn-{{ button.class }}" ng-repeat="button in field.buttons" ng-click="button.click( item )"><i class="{{ button.icon }}"></i> {{ button.label }}</button>
                        </span>
                    </div>
                    <p class="help-block {{ field.model }}-helper" style="height:30px;font-size:12px;">{{ field.desc }}</p>
                </div>

                <!--  -->
                <div class="form-group" ng-if="field.type == 'datepick'">
                    <div class="input-group" on-change="updateDate( variation_tab.models[ field.model ], field.model )" datetimepicker data-ng-model="variation_tab.models[ field.model ]" options="field.options">
                        <span class="input-group-addon">{{ field.label }}</span>
                        <input
                            class="form-control"
                            placeholder="{{ field.placeholder }}"
                            ng-blur="validate.blur( field, variation_tab, {
                                variation_id        :  variation_id,
                                variation_tab_id    :   variation_tab_id
                            })"
                            ng-focus="validate.focus( field, variation_tab, {
                                variation_id        :  variation_id,
                                variation_tab_id    :   variation_tab_id
                            })"
                             />
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                    <p class="help-block {{ field.model }}-helper" style="height:30px;font-size:12px;">{{ field.desc }}</p>
                </div>

                <div class="form-group" ng-if="field.type == 'image_select'">
                    <div class="input-group">
                      <span class="input-group-addon">{{ field.label }}</span>
                      <input
                        ng-model="variation_tab.models[ field.model ]"
                        ng-blur="validate.blur( field, variation_tab, {
                            variation_id        :  variation_id,
                            variation_tab_id    :   variation_tab_id
                        })"
                        ng-focus="validate.focus( field, variation_tab, {
                            variation_id        :  variation_id,
                            variation_tab_id    :   variation_tab_id
                        })"
                        type="text"
                        class="form-control"
                        placeholder="">
                    </div>
                    <p class="help-block {{ field.model }}-helper" style="height:30px;font-size:12px;">{{ field.desc }}</p>
                </div>

                <div
                    class="row"
                    ng-if="field.type == 'group'"
                    ng-init="variation_tab.models[ field.model ] = resetGroup( variation_tab.models[ field.model ] )"
                    >

                    <div
                        class="col-lg-6 col-sm-6 col-xs-12"
                        ng-repeat="(variation_group_id,group_value) in variation_tab.models[ field.model ]"
                        >

                        <div class="box box-primary variation-{{ variation_id }}-tab-{{ variation_tab_id }}-group-{{ variation_group_id }}" style="background:#F1F1F1;" >
                            <div class="box-header with-border variation-{{ variation_id }}-tab-{{ variation_tab_id }}-group-header-{{ variation_group_id }}">
                                <!-- .groups" -->
                                <div class="box-title">
                                    {{ field.label }}
                                </div>
                                <div class="box-tools pull-right">

                                    <span class="badge badge-warning" ng-show="_.keys( variation_tab.models[ field.model ][ variation_group_id ].errors ).length > 0">{{ _.keys( variation_tab.models[ field.model ][ variation_group_id ].errors ).length }}</span>

                                    <button
                                        ng-show="variation_tab.models[ field.model ].length > 1" type="button"

                                        ng-click="removeGroup( variation_group_id, variation_tab.models[ field.model ], {
                                            variation_id        :   variation_id,
                                            variation_tab_id    :   variation_tab_id,
                                            variation_group_id  :   variation_group_id,
                                            variation_tab       :   variation_tab
                                        })"

                                        name="button"

                                        class="btn btn-sm btn-danger"><i class="fa fa-remove"></i>
                                    </button>

                                    <button ng-show="variation_tab.models[ field.model ].length <= groupLengthLimit" type="button" name="button" class="btn btn-sm btn-primary" ng-click="addGroup( variation_tab.models[ field.model ] )"><i class="fa fa-plus" ></i></button>

                                </div>
                            </div>
                            <div class="box-body variation-{{ variation_id }}-tab-{{ variation_tab_id }}-group-body-{{ variation_group_id }}">

                                <div
                                    ng-repeat="( subFieldId, subField ) in field.subFields"
                                    ng-show="subField.show( variation_tab, item, field.subFields )"
                                    >

                                    <div class="form-group" ng-if="subField.type == 'text'">

                                        <div class="input-group">

                                          <span class="input-group-addon">{{ subField.label }}</span>

                                          <input
                                            type="text"
                                            class="form-control"
                                            ng-model="variation_tab.models[ field.model ][ variation_group_id ].models[ subField.model ]"
                                            ng-blur="validate.blur( subField, variation_tab.models[ field.model ][ variation_group_id ], {
                                                variation_id        :   variation_id,
                                                variation_tab_id    :   variation_tab_id,
                                                variation_group_id  :   variation_group_id,
                                                variation_tab       :   variation_tab
                                            })"
                                            ng-focus="validate.focus( subField, variation_tab.models[ field.model ][ variation_group_id ], {
                                              variation_id        :   variation_id,
                                              variation_tab_id    :   variation_tab_id,
                                              variation_group_id  :   variation_group_id,
                                              variation_tab       :   variation_tab
                                            })"
                                            placeholder="{{ subField.placeholder }}"
                                            >
                                            <span ng-show="subField.addon" class="input-group-addon">{{ subField.addon }}</span>

                                        </div>
                                        <p class="help-block {{ subField.model }}-helper" style="height:30px;font-size:12px;">{{ subField.desc }}</p>
                                    </div>

                                    <div class="form-group" ng-if="subField.type == 'select'">
                                        <div class="input-group">
                                            <span class="input-group-addon">{{ subField.label }}</span>
                                            <select class="form-control"
                                                ng-blur="validate.blur( subField, variation_tab.models[ field.model ][ variation_group_id ], {
                                                  variation_id        :   variation_id,
                                                  variation_tab_id    :   variation_tab_id,
                                                  variation_group_id  :   variation_group_id,
                                                  variation_tab       :   variation_tab
                                                })"
                                                ng-focus="validate.focus( subField, variation_tab.models[ field.model ][ variation_group_id ], {
                                                  variation_id        :   variation_id,
                                                  variation_tab_id    :   variation_tab_id,
                                                  variation_group_id  :   variation_group_id,
                                                  variation_tab       :   variation_tab
                                                })"
                                                ng-model="variation_tab.models[ field.model ][ variation_group_id ].models[ subField.model ]">
                                                <option ng-repeat="option in subField.options" value="{{ option.value }}">{{ option.label }}</option>
                                            </select>
                                            <span class="input-group-btn" ng-if="subField.buttons.length > 0">
                                                <button class="btn btn-{{ button.class }}" ng-repeat="button in subField.buttons" ng-click="button.click( item )"><i class="{{ button.icon }}"></i> {{ button.label }}</button>
                                            </span>
                                        </div>
                                        <p class="help-block {{ subField.model }}-helper" style="height:30px;font-size:12px;">{{ subField.desc }}</p>
                                    </div>

                                    <!--  Image Select -->
                                    <div class="form-group" ng-if="subField.type == 'image_select'">
                                        <div class="input-group" ng-if="subField.type == 'image_select'">
                                          <span class="input-group-addon">{{ subField.label }}</span>
                                          <input
                                            ng-model="variation_tab.models[ field.model ][ variation_group_id ].models[ subField.model ]"
                                            ng-focus="validate.focus( subField, variation_tab.models[ field.model ][ variation_group_id ], {
                                              variation_id        :   variation_id,
                                              variation_tab_id    :   variation_tab_id,
                                              variation_group_id  :   variation_group_id,
                                              variation_tab       :   variation_tab
                                            })"
                                            ng-blur="validate.blur( subField, variation_tab.models[ field.model ][ variation_group_id ], {
                                              variation_id        :   variation_id,
                                              variation_tab_id    :   variation_tab_id,
                                              variation_group_id  :   variation_group_id,
                                              variation_tab       :   variation_tab
                                            })"
                                            type="text" class="form-control" placeholder="">
                                        </div>
                                        <p class="help-block {{ subField.model }}-helper" style="height:30px;font-size:12px;">{{ subField.desc }}</p>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div>

      </div>
    </div>
    <!-- /.tab-content -->
</div>
