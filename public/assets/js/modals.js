var modalWrap = null;
/**
 *
 * @param {string} title
 * @param {string} description content of modal body
 * @param {string} yesBtnLabel label of Yes button
 * @param {string} noBtnLabel label of No button
 * @param {function} callback callback function when click Yes button
 */
const showModal = (
  title,
  description,
  callback,
  yesBtnLabel = "Ta bort",
  noBtnLabel = "Avbryt"
) => {
  if (modalWrap !== null) {
    modalWrap.remove();
  }

  modalWrap = document.createElement("div");
  modalWrap.innerHTML = `
<div class="modal fade" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content bg-dark text-white">
          <div class="modal-header">
            <h5 class="modal-title">${title}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p>${description}</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">${noBtnLabel}</button>
            <button onclick="${callback}" type="button" class="btn btn-success" data-bs-dismiss="modal">${yesBtnLabel}</button>
          </div>
        </div>
      </div>
    </div>
  `;

  document.body.append(modalWrap);

  var modal = new bootstrap.Modal(modalWrap.querySelector(".modal"));
  modal.show();
};

function modal(name, slug) {
  switch (name) {
    case "coupon":
      showModal(
        "Radera rabattkod",
        "Är du säker på att du vill radera rabattkoden?",
        `deleteWithSlug('${slug}', '/discount/delete/')`
      );
      break;

    case "sale":
      showModal(
        "Avsluta kampanj",
        "Är du säker på att du vill avsluta kampanjen?",
        `deleteWithSlug('${slug}', '/sale/delete/')`,
        "Avsluta"
      );
      break;

    case "product":
      showModal(
        "Radera produkt",
        "Är du säker på att du vill radera produkten?",
        `deleteWithSlug('${slug}', '/product/delete/')`,
        "Radera"
      );
      break;

    default:
      break;
  }
}

function deleteWithSlug(slug, path) {
  window.location.replace(window.location.origin + "/admin" + path + slug);
}
