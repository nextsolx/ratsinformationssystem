/**
 * Required param in vue component:
 * this.lazyHandle() - data what will be loaded
 */

export default {
    data: () => ({
        observableRootBlock: null,
        observableBlock: '.ris-footer',
        prevRatio: 0,
    }),
    methods: {
        createObserver() {
            let options = {
                root: this.observableRootBlock,
                rootMargin: '0px',
                threshold: this.buildThresholdList()
            };

            const observer = new IntersectionObserver(this.handleIntersect, options),
                observableBlock = document.querySelector(this.observableBlock);
            observer.observe(observableBlock);
        },
        handleIntersect(entries) {
            entries.forEach(entry => {
                if (entry.intersectionRatio > this.prevRatio) {
                    this.lazyHandle();
                }
                this.prevRatio = entry.intersectionRatio;
            });
        },
        buildThresholdList() {
            let thresholds = [],
                numSteps = 20;
            for (let i = 1.0; i <= numSteps; i++) {
                let ratio = i / numSteps;
                thresholds.push(ratio);
            }
            thresholds.push(0);
            return thresholds;
        },
    }
};
