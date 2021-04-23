import CollectionFormController from "./collection_form_controller";
import CollectionFormItemController from "./collection_form_item_controller";

export const registerFormController = (app) => {
    app.register('collection-form', CollectionFormController);
    app.register('collection-form-item', CollectionFormItemController);
};