export default {
    data() {
        return {
            sortedList: [],
            filteredList: [],
        };
    },
    methods: {
        sortBy(unfilteredList,value = 'function') {
            const sortedList = [];
            const values = [];
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
            this.sortedList = [...sortedList];
        },
        filterList (value) {
            if (value) {
                this.filteredList = this.unfilteredList
                    .filter(el => el[this.filterValue].toLowerCase().includes(value.toLowerCase()));
                this.filtered = true;
            }
            else {
                // this.sortBy(this.unfilteredList, this.filterValue);
                this.filtered = false;
            }
        }
    },

};

