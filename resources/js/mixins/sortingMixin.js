export default {
    data() {
        return {
            sortedList: []
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
        }
    },
};

