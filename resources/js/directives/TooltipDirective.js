import Tooltip from 'tooltip.js';

export default {
    bind(el, binding) {
        new Tooltip(el, {
            placement: binding.arg || 'top',
            title: binding.value || el.dataset.tooltipTitle,
            template: '<div class="" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>'
        });
    }
};
