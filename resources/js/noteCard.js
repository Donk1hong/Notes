document.addEventListener("DOMContentLoaded", () => {
    const results = document.getElementById("searchResults");

    if (results) {
        results.addEventListener("click", (e) => {
            const editBtn = e.target.closest(".note-actions .btn[data-id]");
            if (editBtn) {
                e.preventDefault();
                e.stopPropagation();
                const noteId = editBtn.dataset.id;
                const modal = document.getElementById("editModal-" + noteId);
                if (modal) {
                    modal.classList.add("show");
                    modal.querySelectorAll(".closeEdit, .btnEdit, .btnCancel").forEach(el =>
                        el.addEventListener("click", () => modal.classList.remove("show"))
                    );
                }
                return;
            }

            const card = e.target.closest(".note-card");
            if (card) {
                if (e.target.closest("button, form, a")) return;
                const modal = card.nextElementSibling;
                if (modal && modal.classList.contains("noteCardModal")) {
                    modal.classList.add("show");
                    modal.querySelectorAll("#closeNoteCardModal, #closeNoteCardModalBtb").forEach(btn =>
                        btn.addEventListener("click", () => modal.classList.remove("show"))
                    );
                }
            }
        });
    }

    const addBtn = document.getElementById("openModal");
    const createModal = document.getElementById("noteModal");
    if (addBtn && createModal) {
        addBtn.addEventListener("click", (e) => {
            e.preventDefault();
            createModal.classList.add("show");
        });
        createModal.querySelectorAll("#closeModal, #closeBtn, #cancelBtn").forEach(btn =>
            btn.addEventListener("click", () => createModal.classList.remove("show"))
        );
    }

    const input = document.getElementById("searchInput");
    const form  = document.getElementById("noteSearchForm");
    const csrf  = document.querySelector('input[name="_token"]')?.value;

    if (results && input && form && csrf) {
        let timer, controller;

        input.addEventListener("input", () => {
            clearTimeout(timer);
            timer = setTimeout(async () => {
                const query = input.value.trim();

                if (controller) controller.abort();
                controller = new AbortController();

                try {
                    const resp = await fetch(form.action, {
                        method: "POST",
                        signal: controller.signal,
                        credentials: "same-origin",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": csrf,
                            "X-Requested-With": "XMLHttpRequest",
                            "Accept": "text/html"
                        },
                        body: JSON.stringify({ search: query })
                    });

                    if (!resp.ok) {
                        const t = await resp.text().catch(() => "");
                        console.error("Search HTTP error:", resp.status, t);
                        throw new Error(`HTTP ${resp.status}`);
                    }

                    results.innerHTML = await resp.text();
                } catch (err) {
                    if (err.name === "AbortError") return;
                    console.error("Ошибка поиска:", err);
                    results.innerHTML = `
                      <div class="notes-grid no-results-container">
                        <div class="no-results-card">
                          <svg viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10" stroke-width="2"></circle>
                            <line x1="8" y1="8" x2="16" y2="16" stroke-width="2"></line>
                            <line x1="16" y1="8" x2="8" y2="16" stroke-width="2"></line>
                          </svg>
                          <p>Ошибка запроса</p>
                        </div>
                      </div>`;
                }
            }, 300);
        });

        form.addEventListener("keydown", (e) => {
            if (e.key === "Enter" || e.keyCode === 13) e.preventDefault();
        });
    }
});
