import {computed , isRef} from 'vue'

export const useMonthlPayment = (total, interestRate,duration) => {
    const mothlyPayment = computed(()=>{
        const principle = isRef(total) ? total.value : total
        const monthlyInterest = (isRef(interestRate) ? interestRate.value : interestRate )/100/12
        const numberOfPaymentMonths = (isRef(duration) ? duration.value : duration)  *12

        return principle * monthlyInterest * (Math.pow(1 + monthlyInterest, numberOfPaymentMonths)) / (Math.pow(1 + monthlyInterest, numberOfPaymentMonths) - 1)
    })

    const totalPaid = computed(()=> {
        return (isRef(duration) ? duration.value :duration) * 12 * mothlyPayment.value
    })
    const totalInterest = computed(()=>{
        return totalPaid.value - (isRef(total) ? total.value : total)
    })
    return {mothlyPayment , totalPaid, totalInterest} 
}