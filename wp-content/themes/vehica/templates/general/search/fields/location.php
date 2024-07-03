<?php
/* @var \Vehica\Search\Field\LocationSearchField $vehicaSearchField */
/* @var \Vehica\Widgets\General\SearchV1GeneralWidget $vehicaCurrentWidget */
global $vehicaSearchField, $vehicaCurrentWidget;

if (empty(vehicaApp('google_maps_api_key'))) {
    ?>
    <div class="vehica-no-google-map-api-key">
        <i class="fa fa-exclamation-triangle"></i>
        <span><?php echo esc_html(vehicaApp('please_add_google_maps_api_string')); ?></span>
    </div>
    <?php
    return;
}
?>
    <div
        <?php if ($vehicaSearchField->showMyLocationButton()) : ?>
            class="vehica-search__field vehica-display-show-my-location vehica-relation-field <?php echo esc_attr($vehicaSearchField->getClass()); ?>"
        <?php else : ?>
            class="vehica-search__field vehica-relation-field <?php echo esc_attr($vehicaSearchField->getClass()); ?>"
        <?php endif; ?>
    >
        <vehica-location-search-field
                :location-field="<?php echo htmlspecialchars(json_encode($vehicaSearchField)); ?>"
                :filters="searchFormProps.filters"
                :set-initial-location="<?php echo esc_attr($vehicaSearchField->askForLocation() ? 'true' : 'false'); ?>"
                custom-label="<?php echo esc_attr(vehicaApp('selected_area_on_the_map_string')); ?>"
        >
            <div
                    slot-scope="locationField"
                    class="vehica-text-field"
                    :class="{'vehica-field-filled': locationField.value !== ''}"
            >
                <input
                        class="vehica-location-<?php echo esc_attr($vehicaSearchField->getId()); ?>"
                        type="text"
                        placeholder="<?php echo esc_attr($vehicaSearchField->getPlaceholder()); ?>"
                >

                <?php if ($vehicaSearchField->showMyLocationButton()) : ?>
                    <div class="vehica-show--my-location">
                        <i @click.prevent="locationField.getCurrentLocation" class="fas fa-crosshairs"></i>
                        <div class="vehica-show--my-location__label">
                            <?php echo esc_attr(vehicaApp('my_location_string')); ?>
                        </div>
                    </div>
                <?php endif; ?>

                <template>
                    <span
                            v-if="locationField.value !== ''"
                            class="vehica-form-button__clear vehica-form-button__clear--text"
                            @click.prevent="locationField.onClear"
                    >
                        <i class="fas fa-times"></i>
                    </span>
                </template>
            </div>
        </vehica-location-search-field>
    </div>

<?php
if ($vehicaSearchField->showRadiusControl()) :
    $vehicaRadiusOptions = $vehicaSearchField->getRadiusOptions();
    $vehicaRadiusInitial = $vehicaSearchField->getDefaultRadiusOption();
    ?>
    <div class="vehica-search__field vehica-search__field--radius vehica-relation-field">
        <vehica-radius-search-field
                :location-field="<?php echo htmlspecialchars(json_encode($vehicaSearchField)); ?>"
                :filters="searchFormProps.filters"
            <?php if (!empty($vehicaRadiusInitial)) : ?>
                :initial-radius="<?php echo htmlspecialchars(json_encode($vehicaRadiusInitial)); ?>"
            <?php endif; ?>
            <?php if (!empty($vehicaRadiusOptions)) : ?>
                :options="<?php echo htmlspecialchars(json_encode($vehicaRadiusOptions)); ?>"
            <?php endif; ?>
        >
            <div
                    slot-scope="radiusField"
                    :class="{'vehica-active-number': radiusField.value !== ''}"
            >

                <div v-if="false" class="vehica-form-button"></div>

                <template>
                    <v-select
                            label="label"
                            :options="radiusField.options"
                            :value="radiusField.value"
                            @input="radiusField.setValue"
                            :append-to-body="false"
                            :searchable="false"
                            placeholder="<?php echo esc_attr($vehicaSearchField->getRadiusPlaceholder()); ?>"
                            :disabled="radiusField.isDisabled"
                    >
                        <template #option="option">
                            <div class="vehica-option">
                                <span v-html="option.label"></span>
                            </div>
                        </template>

                        <template #selected-option-container="{ option, deselect, multiple, disabled }">
                            <div style="z-index: 100000;" class="vs__selected">
                                <span class="vehica-option-selected"><span v-html="option.label"></span></span>
                            </div>
                        </template>
                    </v-select>
                </template>

            </div>
        </vehica-radius-search-field>
    </div>
<?php
endif;