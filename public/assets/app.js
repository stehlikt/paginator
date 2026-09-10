const mobileQuery = window.matchMedia('(max-width: 760px)');
function synchronizePerPage() {
    const expectedPerPage = mobileQuery.matches ? 10 : 20;
    const renderedPerPage = Number(document.body.dataset.perPage);

    if (renderedPerPage === expectedPerPage) {
        return;
    }

    const url = new URL(window.location.href);
    url.searchParams.set('per_page', String(expectedPerPage));
    url.searchParams.set('page', '1');
    window.location.href = url.toString();
}

synchronizePerPage();

mobileQuery.addEventListener('change', synchronizePerPage);