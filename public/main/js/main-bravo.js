var $ = jQuery.noConflict();

$(document).ready(function () {
    console.log('textStatus');
    $(document).click(function({target}) {
        if(!target.closest(".category-page__aside")) {
            $(".category-page__aside").removeClass('active')
        }
    })
    tippy('.popover', {
        allowHTML: true,
        maxWidth: 600
    });
    let drops = document.querySelectorAll('[data-dropdown="dropdown"]');

    if(drops) {
        drops.forEach(item => {
            var dropdown = new dropdownInit(item, {})

        })
    }

    const element2 = document.querySelectorAll('.select-default');
    if(element2){
        element2.forEach(item => {
            const example2 = new Choices(item, {
                removeItemButton: true,
            });
        })
    }

    let selectCheckbox = document.querySelectorAll('.select-checkbox');

    selectCheckbox.forEach(item => {

        const choices = new Choices(item, {
            searchChoices: false,
            searchEnabled: false,
            allowHTML: true,
            shouldSort: false,
            classNames: {
                containerOuter: 'choices select-checkbox',
                selectedState: 'is-selected',
            },
            callbackOnCreateTemplates: function (template) {
                let itemSelectText = this.config.itemSelectText;
                return {
                    item: function ({ classNames }, data) {
                        return template(`
                        <div
                            class="${String(classNames.item)} ${String(data.highlighted ? classNames.highlightedState : classNames.itemSelectable)} "
                            data-item
                            data-value="Sort by"
                            ${String(data.active ? 'aria-selected="true"' : '')}
                            ${String(data.disabled ? 'aria-disabled="true"' : '')}>
                            Sort by
                        </div>
                        `);
                    },
                    choice: function ({ classNames }, data) {
                        // console.log(data)
                        return template(`
                        <div
                            class="${String(classNames.item)} ${String(classNames.itemChoice)} ${String(data.disabled ? classNames.itemDisabled : classNames.itemSelectable)} ${String(data.selected ? classNames.selectedState : '')} d-flex align-items-center"

                            ${String(data.groupId > 0 ? 'role="treeitem"' : 'role="option"')}>
                            <label class="custom-checkbox">
                                <input type="checkbox"
                                name="${String(data.customProperties.name)}" id="${String(data.customProperties.id)}" class="custom-checkbox__input"
                                ${String(data.customProperties.selected==="true" ? 'checked' : '')}
                                >
                                <span class="custom-checkbox__input-fake me-3">
                                </span>
                                <span class='text-data'>
                                    <span>${String(data.label)}</span>
                                </span>
                            </label>
                        </div>`)

                    }
                }
            }
        });



    });

   $('.sidebar-open').click(function(e) {
        e.preventDefault()
        $('.category-page__aside').toggleClass('active')
   })
   $('.sidebar-close').click(function(e) {
        e.preventDefault()
        $('.category-page__aside').removeClass('active')
   })
});
window.dropdownInit = class dropdownInit {
    constructor(item, opt = {}) {
        this.element = item ;
        this.elementBtn = this.element.querySelector('[data-role="button"]');
        this.elementBody = this.element.querySelector('[data-role="dropdown"]');
        this.topPos = null;
        this.leftPos = null;
        this.transformY = 0;
        this.transformX = 0;
        this.isOpen = false;
        this.events = {};
        this.options = {
            position: 'top-start',
            autoPositions: true,
            insideoverflow: true,
            corectionx: true,
            mobileGutters: 15,
            container: 'body',
            ...opt,
            ...this.element.dataset
        };
        this.#listeners()
    }
    #listeners() {
        this.elementBtn.addEventListener('click', this.dropdownHandler.bind(this))
        document.addEventListener('click', this.clickOutside.bind(this))
        window.addEventListener('resize', this.renderPosition.bind(this))
        document.addEventListener('scroll', this.dropdownClose.bind(this))
    }
    // getters
    get ElementReact() {
        return this.element.getBoundingClientRect()
    }
    get DropdownReact() {
        return this.elementBody.getBoundingClientRect()
    }
    on(type, callback) {
        if (this.events[type]) {
            this.events[type].push(callback)
        } else {
            this.events[type] = [callback]
        }
    }
    renderPosition() {
        if (!this.isOpen) return
        const windowHeight = window.innerHeight
        const windowWidth = window.innerWidth
        let syle = getComputedStyle(this.elementBody, null)
        let guttersY = parseFloat(syle.getPropertyValue('margin-top')) || 0
        let widthDrop = this.DropdownReact.width > (windowWidth - (this.options.mobileGutters * 2)) ? windowWidth - (this.options.mobileGutters * 2)  :   this.DropdownReact.width
        if (this.options.insideoverflow != 'false') {
            this.topPos = this.ElementReact.top + this.elementBtn.clientHeight
            this.leftPos = this.ElementReact.left
            if (this.options.position === 'top-end') {
                // this.transformX = `-${this.DropdownReact.width - this.elementBtn.clientWidth}px`
                this.leftPos =  this.ElementReact.right - widthDrop;
            }
            if (this.options.position === 'bottom-start') {
                this.transformY = `-${this.DropdownReact.height + this.elementBtn.clientHeight + (guttersY * 2)}px`
            }
            if (this.options.position === 'bottom-end') {
                // this.transformX = `-${this.DropdownReact.width - this.elementBtn.clientWidth}px`
                this.leftPos =  this.ElementReact.right - widthDrop;
                this.transformY = `-${this.DropdownReact.height + this.elementBtn.clientHeight + (guttersY * 2)}px`
            }
        }
        if (this.options.autoPositions) {
            if (windowHeight - this.ElementReact.bottom < this.DropdownReact.height && this.ElementReact.top > this.DropdownReact.height) {
                this.transformY = `-${this.DropdownReact.height + this.elementBtn.clientHeight + (guttersY * 2)}px`
            } else if(windowHeight - this.ElementReact.bottom < this.DropdownReact.height && this.ElementReact.top < this.DropdownReact.height){
                this.transformY = 0;
                this.topPos = windowHeight - this.DropdownReact.height - (guttersY * 2)
            } else {
                this.transformY = 0;
            }
        }

        if(this.options.corectionx != "false" ) {
            if (this.ElementReact.left + this.ElementReact.width - this.options.mobileGutters < widthDrop
                && this.options.position === 'bottom-end') {
                this.leftPos = this.options.mobileGutters
                this.transformX = 0
            }
            if (this.leftPos < widthDrop && this.options.position === 'top-end') {
                this.leftPos = windowWidth - widthDrop - this.options.mobileGutters
                this.transformX = 0
            }
        }
        this.applyStyles(this.elementBody, {
            top: this.topPos + 'px',
            left: this.leftPos + 'px',
            transform: `translate(${this.transformX}, ${this.transformY})`,
            width: widthDrop + 'px',
            maxWidth: windowWidth - this.options.mobileGutters * 2 + 'px',
            maxHeight: windowHeight - this.options.mobileGutters * 2 + 'px'
        })
    }
    removeDropdouwnEl() {
        this.elementBody.remove();
    }
    pushInsideBody() {
        document.querySelector(this.options.container).append(this.elementBody)
    }
    pushInsadeEl() {
        this.element.append(this.elementBody)
    }
    dropdownHandler(e) {
        e.preventDefault()
        this.toggle()
    }
    toggle() {
        return this.isOpen ? this.dropdownClose() : this.open();
    }
    open() {
        this.isOpen = true
        if (this.events.open && this.events.open.length) this.events.open.forEach(item => item(this.isOpen))
        this.elementBody.classList.add('is-open');
        this.element.classList.add('dropdown-open')
        this.renderPosition()
        if (this.options.insideoverflow != 'false') {
            this.removeDropdouwnEl()
            this.pushInsideBody()
        }
    }
    dropdownClose() {
        this.isOpen = false
        if (this.events.close && this.events.close.length) this.events.close.forEach(item => item(this.isOpen))
        this.element.classList.remove('dropdown-open');
        this.elementBody.classList.remove('is-open');
        this.elementBody.removeAttribute('style')
        if (this.options.insideoverflow != 'false') {
            this.removeDropdouwnEl()
            this.pushInsadeEl()
        }
    }
    applyStyles(element, style) {
        Object.assign(element.style, style)
    }
    clickOutside({ target }) {
        if (target.closest('[data-dropdown="dropdown"]') != this.element
        && this.isOpen && target.closest('[data-role="dropdown"]') != this.elementBody) {
            this.dropdownClose()
        }
    }
    destroy() {
        this.elementBtn.removeEventListener('click', this.dropdownHandler)
        document.removeEventListener('click', this.clickOutside)
        window.removeEventListener('resize', this.renderPosition)
        document.removeEventListener('scroll', this.dropdownClose)
    }
}


var rangeSliderWrapper = document.querySelectorAll('.price-slider');

    if(rangeSliderWrapper) {
        rangeSliderWrapper.forEach(item => {
            let slider = item.querySelector('.slider')
            let htmlValues = [
                item.querySelector('.min-value'),
                item.querySelector('.max-value')
            ]
            let min = +item.dataset.min
            let max = +item.dataset.max
            noUiSlider.create(slider , {
                start: [min, max],
                connect: true,
                step: 1,
                range: {
                    'min': min,
                    'max': max
                }
            });
            slider.noUiSlider.on('update', function (values, handle, unencoded) {
                htmlValues[handle].innerHTML = '$' + Number(values[handle]).toFixed(0)
            })
        })
    }

let sliderCategories = document.querySelectorAll(".slader-category-wrapper")
if(sliderCategories) {
    sliderCategories.forEach(item => {
        let slider = item.querySelector(".slider-categoryes")
        let btnNext = item.querySelector(".category-btn-next")
        let btnPrev = item.querySelector(".category-btn-prev")
        var swiper = new Swiper(slider, {
            slidesPerView: 5,
            spaceBetween: 40,
            centeredSlides: true,
            initialSlide: 3,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
              nextEl: btnNext,
              prevEl: btnPrev,
            },
            breakpoints: {
                320: {
                  slidesPerView: 1.5,
                },
                460: {
                    slidesPerView: 2.5,
                },
                768: {
                    slidesPerView: 3.5,
                },
                1100: {
                    slidesPerView: 5,
                },
            }
          });
    })
}
let sliderProducts = document.querySelectorAll(".slider-pruduct-wrapper")
if(sliderProducts) {
    sliderProducts.forEach(item => {
        let slider = item.querySelector(".slider-products")
        let btnNext = item.querySelector(".category-btn-next")
        let btnPrev = item.querySelector(".category-btn-prev")
        var swiper = new Swiper(slider, {
            slidesPerView: 4,
            spaceBetween: 40,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
              nextEl: btnNext,
              prevEl: btnPrev,
            },
            breakpoints: {
                320: {
                  slidesPerView: 1.3,
                },
                560: {
                    slidesPerView: 2.3,
                },
                768: {
                    slidesPerView: 3.3,
                },
                1100: {
                    slidesPerView: 4,
                },
            }
          });
    })
}
