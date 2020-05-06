<template>
    <table>
        <thead>
            <tr>
                <th></th>
                <th v-for="(day, index) in weekdays" :key="index">{{ day }}</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(hour, i) in hours" :key="i">
                <td>
                    {{ formatHour(hour) }}
                    <small>{{ hour < 12 ? 'A:M' : 'P:M' }}</small>
                </td>
                <td v-for="(day, j) in weekdays.length" :key="j">
                    <label>
                        <input
                            type="checkbox"
                            @change="handleCheckboxChange($event, j, hour)"
                        />
                        <span></span>
                    </label>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script>
const range = (from, to) => [...Array(to - from + 1).keys()].map(i => i + from)

export default {
    props: {
        value: Object,
        readonly: Boolean,
    },

    data: () => ({}),

    computed: {
        hours: () => range(5, 12 + 5),

        weekdays: () => [
            'Domingo',
            'Lunes',
            'Martes',
            'Miercoles',
            'Jueves',
            'Viernes',
            'Sabado',
        ],
    },

    methods: {
        formatHour(hour) {
            if (hour < 12) return `${hour}:00`
            else return `${hour - 12 || 12}:00`
        },

        handleCheckboxChange(e, day, hour) {
            const value = { ...this.value }
            const isChecked = e.target.checked

            const start = hour
            const end = start + 1
            let ranges = [...(value[day] || [])]
            ranges = isChecked
                ? this.add(ranges, start, end)
                : this.remove(ranges, start, end)

            value[day] = ranges
            this.$emit('input', value)
        },

        add(ranges, start, end) {
            let changed = false

            if (ranges.length > 1) {
                const a = ranges.findIndex(range => range[1] === start)
                const b = ranges.findIndex(range => range[0] === end)

                if (a >= 0 && b >= 0) {
                    ranges[a][1] = ranges.splice(b, 1)[0][1]
                    changed = true
                }
            }

            if (!changed) {
                const a = ranges.findIndex(range => range[1] === start)
                const b = a >= 0 || ranges.findIndex(range => range[0] === end)

                if (a >= 0) ranges[a][1] = end
                else if (b >= 0) ranges[b][0] = start
                else ranges.push([start, end])
            }

            return ranges
        },

        remove(ranges, start, end) {
            const index = ranges.findIndex(
                range =>
                    range[1] - range[0] >= 3 &&
                    range[0] < start &&
                    range[1] > end
            )

            if (index >= 0) {
                ranges.splice(index + 1, 0, [end, ranges[index][1]])
                ranges[index][1] = start
            } else {
                const a = ranges.findIndex(
                    range => range[0] === start && range[1] === end
                )
                const b =
                    a >= 0 || ranges.findIndex(range => range[0] === start)
                const c = b >= 0 || ranges.findIndex(range => range[1] === end)

                if (a >= 0) ranges.splice(a, 1)
                else if (b >= 0) ranges[b][0] = end
                else if (c >= 0) ranges[c][1] = start
            }

            return ranges
        },

        isChecked(day, hour) {
            return false
        },
    },
}
</script>

<style lang="scss" scoped>
$border-color: color('gray', 700);
$border-width: 1px;

table {
    table-layout: fixed;
    width: 100%;
}

thead {
    border-bottom: $border-width solid $border-color;

    th:first-child {
        text-align: right;
        width: 105px;
    }
}

tbody tr {
    td {
        vertical-align: middle;
        border: $border-width solid $border-color;
        &:first-child {
            text-align: center;
        }
    }

    input[type='checkbox'] {
        @include hide-visually;
        &:checked + span {
            background: color('primary', 300) !important;
        }
    }

    span {
        @include size(100%, 35px);

        display: block;
        cursor: pointer;
    }
}
</style>
