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
    enter_text("/html/body/form/section/div/div/div/div/div/div[1]/input", "admin@test.com") # Email field
    enter_text("/html/body/form/section/div/div/div/div/div/div[2]/input", "P@ssword1") # Password field

    # Clicks the login button
    driver.find_element(By.XPATH, "/html/body/form/section/div/div/div/div/div/button").click()
    
    # Checks the user has been logged in
    assert "Inventory Page" in driver.title

    # Clicks on the edit button for the last item
    driver.find_element(By.XPATH, "/html/body/div[1]/table/tbody[2]/tr[last()]/td[9]/form[1]/button").click()

    # Text and image inputs
    enter_text("/html/body/div[2]/div/div/div[2]/form/div[1]/input", "C:/laragon/www/SCDT61_CW2/Selenium/Equipment/images/Apple.avif") # Item image

    enter_text("/html/body/div[2]/div/div/div[2]/form/div[2]/input", "New name") # Item name
    enter_text("/html/body/div[2]/div/div/div[2]/form/div[3]/input", "New description") # Item description
    enter_text("/html/body/div[2]/div/div/div[2]/form/div[4]/input", "1.00") # Item sell price
    enter_text("/html/body/div[2]/div/div/div[2]/form/div[5]/input", "2.50") # Item buy price
    enter_text("/html/body/div[2]/div/div/div[2]/form/div[6]/input", "200") # Item stock

    # Dropdown inputs
    driver.find_element(By.XPATH, "/html/body/div[2]/div/div/div[2]/form/div[7]/select").click() # Opens category dropdown 
    driver.find_element(By.XPATH, "/html/body/div[2]/div/div/div[2]/form/div[7]/select/option[3]").click() # Picks third option
    driver.find_element(By.XPATH, "/html/body/div[2]/div/div/div[2]/form/div[8]/select").click() # Opens supplier dropdown
    driver.find_element(By.XPATH, "/html/body/div[2]/div/div/div[2]/form/div[8]/select/option[3]").click() # Picks third option

    # Clicks the confirm button
    driver.find_element(By.XPATH, "/html/body/div[2]/div/div/div[2]/form/div[9]/button[1]").click()

    # Checks the page has been reloaded
    assert "Inventory Page" in driver.title

    # Waits 60 seconds before closing the chrome tab
    time.sleep(60)


if __name__ == "__main__":
    main()