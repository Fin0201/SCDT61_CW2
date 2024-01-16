from selenium import webdriver
from selenium.webdriver.common.by import By
import time

# Sets the Selenium webdriver to Chrome
driver = webdriver.Chrome()

# Function used to enter text into an input field
def enter_text(input_xpath, new_text):
    # Find Element by XPATH
    input = driver.find_element(By.XPATH, input_xpath)

    # Clears the input. Necessary if there is already text in the input
    input.clear()

    # Enter text into the element
    input.send_keys(new_text)


def main():
    # Load Webpage
    driver.get("http://localhost/SCDT61_CW2/")

    # Check the correct page has been loaded
    assert "Home" in driver.title

    # Clicks on the login navbar button
    driver.find_element(By.XPATH, "/html/body/nav/div/ul/li[8]/a").click()

    # Checks the register page has been loaded
    assert "Login Page" in driver.title

    # Enters text into the login form
    login_email = "admin@test.com"
    login_password = "P@ssword1"
    enter_text("/html/body/form/section/div/div/div/div/div/div[1]/input", login_email) # Email field
    enter_text("/html/body/form/section/div/div/div/div/div/div[2]/input", login_password) # Password field

    # Clicks the login button
    driver.find_element(By.XPATH, "/html/body/form/section/div/div/div/div/div/button").click()
    
    # Checks the user has been logged in
    assert "Inventory Page" in driver.title

    # Clicks on the edit button for the selected item
    table_row = "last()" # Selects the last row in the table
    driver.find_element(By.XPATH, f"/html/body/div[1]/table/tbody[2]/tr[{table_row}]/td[9]/form[1]/button").click()

    # Text and image inputs
    equip_image_path = "C:/laragon/www/SCDT61_CW2/Selenium/Equipment/images/Apple.webp"
    equip_name = "New name"
    equip_desc = "New description"
    equip_sell_price = "1.00"
    equip_buy_price = "2.50"
    equip_stock = "200"
    enter_text("/html/body/div[2]/div/div/div[2]/form/div[1]/input", equip_image_path) # Item image
    enter_text("/html/body/div[2]/div/div/div[2]/form/div[2]/input", equip_name) # Item name
    enter_text("/html/body/div[2]/div/div/div[2]/form/div[3]/input", equip_desc) # Item description
    enter_text("/html/body/div[2]/div/div/div[2]/form/div[4]/input", equip_sell_price) # Item sell price
    enter_text("/html/body/div[2]/div/div/div[2]/form/div[5]/input", equip_buy_price) # Item buy price
    enter_text("/html/body/div[2]/div/div/div[2]/form/div[6]/input", equip_stock) # Item stock

    # Dropdown inputs
    category_option = "3"
    supplier_option = "3"
    driver.find_element(By.XPATH, "/html/body/div[2]/div/div/div[2]/form/div[7]/select").click() # Opens category dropdown 
    driver.find_element(By.XPATH, f"/html/body/div[2]/div/div/div[2]/form/div[7]/select/option[{category_option}]").click()
    driver.find_element(By.XPATH, "/html/body/div[2]/div/div/div[2]/form/div[8]/select").click() # Opens supplier dropdown
    driver.find_element(By.XPATH, f"/html/body/div[2]/div/div/div[2]/form/div[8]/select/option[{supplier_option}]").click()

    # Clicks the confirm button
    driver.find_element(By.XPATH, "/html/body/div[2]/div/div/div[2]/form/div[9]/button[1]").click()

    # Checks the page has been reloaded
    assert "Inventory Page" in driver.title

    # Waits 60 seconds before closing the chrome tab
    time.sleep(60)


if __name__ == "__main__":
    main()