export default {
    data() {
        return {
            filteredList: []
        };
    },
    methods: {
        sortBy(unfilteredList,value = 'function') {
            let values = [];
            unfilteredList
                .forEach(el => {
                    if (!values.includes(el[value])) {
                        values.push(el[value]);
                        let arr = unfilteredList.filter(el => el[value] === values[values.length - 1]);
                        this.filteredList.push({
                            data: arr,
                            title: values[values.length - 1]
                        });
                    }
                });
        },
    },
};

