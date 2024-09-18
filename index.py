# Функция для вычисления сложного процента
def calculate_compound_interest(principal, rate, times):
    for period in range(1, times + 1):
        principal += principal * rate
        print(f"Period {period}: {principal:.0f}$")
    return principal

# Основной код
if __name__ == "__main__":
    initial_amount = 1600  # начальная сумма
    interest_rate = 0.032  # процентная ставка
    periods = 7  # количество периодов

    final_amount = calculate_compound_interest(initial_amount, interest_rate, periods)
    print(f"Final amount after {periods} periods: {final_amount:.2f}")
