export default {
    data() {
        return {
            sortedList: [],
            filteredList: [],
        };
    },
    methods: {
        sortBy(unfilteredList,value = 'function', char = false) {
            const sortedList = [];
            const values = [];
            if (char) {
                unfilteredList
                    .sort((a, b) => a[value] === b[value] ? 0 : +(a[value] > b[value]) || -1)
                    .forEach(el => {
                        if (!el[value]) return;
                        if (!values.includes(el[value][0].toLowerCase())) {
                            values.push(el[value][0].toLowerCase());
                            let arr = unfilteredList.filter(el => {
                                if (!el[value]) return;
                                return el[value][0].toLowerCase() === values[values.length - 1];
                            });
                            sortedList.push({
                                data: arr,
                                title: values[values.length - 1]
                            });
                        }
                    });
            } else {
                unfilteredList
                    .forEach(el => {
                        if (!values.includes(el[value])) {
                            values.push(el[value]);
                            let arr = unfilteredList.filter(el => el[value] === values[values.length - 1]);
                            sortedList.push({
                                data: arr,
                                title: values[values.length - 1]
                            });
                        }
                    });
            }
            this.sortedList = [...sortedList];
        },
        filterList (value) {
            if (value) {
                this.filteredList = this.unfilteredList
                    .filter(el => el[this.filterValue].toLowerCase().includes(value.toLowerCase()));
                this.filtered = true;
            }
            else {
                this.filtered = false;
            }
        }
    },

};

