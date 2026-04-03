import './bootstrap';


new Sortable(document.querySelectorAll('.slot'), {
    group: 'tasks',
    animation: 150,
    onEnd: function (evt) {
        let taskId = evt.item.dataset.id;
        let newDate = evt.to.dataset.date;
        let newSlot = evt.to.dataset.slot;

        fetch('/planner/update', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrf
            },
            body: JSON.stringify({
                id: taskId,
                planned_date: newDate,
                time_slot: newSlot
            })
        });
    }
});