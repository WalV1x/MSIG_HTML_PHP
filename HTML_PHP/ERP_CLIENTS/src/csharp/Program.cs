using System;
using System.Data;
using System.Data.SqlClient;
using System.Security.Cryptography;
using System.Text;
using System.Threading;
using Microsoft.Data.Sqlite;
using MySqlConnector;

string m_strMySQLConnectionString;
m_strMySQLConnectionString = "server=localhost;userid=root;password=root;database=db_Clients_Prog;port=6033";

DisplayMainMenu();

void DisplayMainMenu()
{
    Console.CursorVisible = false;

    while (true)
    {
        Console.Title = "ERP - Menu";
        Console.Clear();

        Console.ForegroundColor = ConsoleColor.White;

        int optionWelcome = 1;
        bool isSelectedWelcome = false;
        string colorWelcome = "    \u001B[32m";

        while (!isSelectedWelcome)
        {
            int topWelcome = Console.WindowHeight / 2;

            string welcome = @"
 ________  _______     _______   
|_   __  ||_   __ \   |_   __ \  
  | |_ \_|  | |__) |    | |__) | 
  |  _| _   |  __ /     |  ___/  
 _| |__/ | _| |  \ \_  _| |_     
|________||____| |___||_____|  
";

            string[] welcomeLines = welcome.Split("\n");
            int welcomeHeight = Console.WindowHeight / 2 - 6;

            for (int i = 0; i < welcomeLines.Length; i++)
            {
                Console.CursorLeft = Console.WindowWidth / 2 - (welcomeLines[i].Length / 2 - 4);
                Console.CursorTop = welcomeHeight + i;
                Console.ForegroundColor = ConsoleColor.White;
                Console.WriteLine(welcomeLines[i]);
            }

            Console.SetCursorPosition((Console.WindowWidth - "Clients".Length) / 2, topWelcome + 3);
            Console.WriteLine($"{(optionWelcome == 1 ? colorWelcome : "    ")}Clients\u001b[0m");

            Console.SetCursorPosition((Console.WindowWidth - "Produits".Length) / 2, topWelcome + 4);
            Console.WriteLine($"{(optionWelcome == 2 ? colorWelcome : "    ")}Produits\u001b[0m");

            Console.SetCursorPosition((Console.WindowWidth - "Commandes".Length) / 2, topWelcome + 5);
            Console.WriteLine($"{(optionWelcome == 3 ? colorWelcome : "    ")}Commandes\u001b[0m");

            Console.SetCursorPosition((Console.WindowWidth - "Quitter".Length) / 2, topWelcome + 6);
            Console.WriteLine($"{(optionWelcome == 4 ? colorWelcome : "    ")}Quitter\u001b[0m");

            var keyWelcome = Console.ReadKey(true);

            switch (keyWelcome.Key)
            {
                case ConsoleKey.UpArrow:
                    optionWelcome = optionWelcome == 1 ? 4 : optionWelcome - 1;
                    break;

                case ConsoleKey.DownArrow:
                    optionWelcome = optionWelcome == 4 ? 1 : optionWelcome + 1;
                    break;

                case ConsoleKey.Enter:
                    isSelectedWelcome = true;
                    break;
            }
        }

        if (optionWelcome == 1)
        {
            Clients_CSV();
        }
        else if (optionWelcome == 2)
        {

        }
        else if (optionWelcome == 3)
        {

        }
        else if (optionWelcome == 4)
        {
            Exitprogram();
        }
    }
}

void Clients_CSV()
{
    Console.Clear();

    using (var mysqlconnection = new MySqlConnection(m_strMySQLConnectionString))
    {
        mysqlconnection.Open();
        int added = 0;

        string filepath = @"C:\Users\pt50cuy\Desktop\HTML_PHP\3. WEB\HTML_PHP\ERP_CLIENTS\src\sql\Clients-Clean-Id.csv";

        try
        {
            foreach (string line in File.ReadAllLines(filepath))
            {
                var columns = line.Split(";");
                string firstname = columns[1].ToLower();
                string lastname = columns[2].ToLower();
                string companyname = columns[3].ToLower();
                string address = columns[4].ToLower();
                string city = columns[5].ToLower();
                string county = columns[6].ToLower();
                string state = columns[7].ToLower();
                string zip = columns[8].ToLower();
                string phone1 = columns[9].ToLower();
                string phone2 = columns[10].ToLower();
                string email = columns[11].ToLower();
                string web = columns[12].ToLower();

                string login = GenerateLogin(firstname, lastname);

                string checkSql = "Select Count(*) From clients where login = @login";

                //CHATGPT Aide
                using (MySqlCommand checkCmd = new MySqlCommand(checkSql, mysqlconnection))
                {
                    checkCmd.Parameters.AddWithValue("@Login", login);

                    //https://learn.microsoft.com/en-us/dotnet/api/system.data.sqlclient.sqlcommand.executescalar?view=dotnet-plat-ext-8.0 
                    object result = checkCmd.ExecuteScalar();
                    if (result != null && int.Parse(result.ToString()) > 0)
                    {
                        Console.WriteLine($"Doublon, de {login}");
                        continue;
                    }
                }

                string password = GenerateRandomPassword(10);
                string hashedPassword = HashPassword(password);

                string sql = @"
INSERT INTO clients (first_name, last_name, company_name, address, city, county, state, zip, phone1, phone2, email, web, login, password)
VALUES
(@FirstName, @LastName, @Companyname, @Address, @City, @County, @State, @Zip, @Phone1, @Phone2, @Email, @Web, @Login, @Password)";

                using (MySqlCommand cmd = mysqlconnection.CreateCommand())
                {
                    cmd.Parameters.AddWithValue("@FirstName", firstname);
                    cmd.Parameters.AddWithValue("@LastName", lastname);
                    cmd.Parameters.AddWithValue("@Companyname", companyname);
                    cmd.Parameters.AddWithValue("@Address", address);
                    cmd.Parameters.AddWithValue("@City", city);
                    cmd.Parameters.AddWithValue("@County", county);
                    cmd.Parameters.AddWithValue("@State", state);
                    cmd.Parameters.AddWithValue("@Zip", zip);
                    cmd.Parameters.AddWithValue("@Phone1", phone1);
                    cmd.Parameters.AddWithValue("@Phone2", phone2);
                    cmd.Parameters.AddWithValue("@Email", email);
                    cmd.Parameters.AddWithValue("@Web", web);
                    cmd.Parameters.AddWithValue("@Login", login);
                    cmd.Parameters.AddWithValue("@Password", hashedPassword);

                    cmd.CommandType = CommandType.Text;
                    cmd.CommandTimeout = 300;
                    cmd.CommandText = sql;

                    added = added + cmd.ExecuteNonQuery();

                    Console.WriteLine($"{firstname} {lastname} {companyname} {address} {city} {county} {state} {zip} {phone1} {phone2} {email} {web} {login} {hashedPassword}");
                }
            }
            Console.WriteLine($"Added {added} records...");
        }
        catch (Exception ex)
        {
            Console.WriteLine($"An error occurred: {ex.Message}");
        }
        finally
        {
            mysqlconnection.Close();
        }

        Console.ReadLine();
    }
}

string GenerateLogin(string firstname, string lastname)
{
    string generatedLogin = string.Empty;

    if (!string.IsNullOrEmpty(firstname) && !string.IsNullOrEmpty(lastname))
    {
        generatedLogin = firstname.Substring(0, 2) + lastname;
    }

    string generatedLoginNew = generatedLogin.Replace("\"", "");

    return generatedLoginNew;
}

string GenerateRandomPassword(int length)
{
    string Characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

    Random random = new Random();
    string password = string.Empty;

    for (int i = 0; i < length; i++)
    {
        int index = random.Next(Characters.Length);
        password += Characters[index];
    }

    return password;
}

string HashPassword(string password)
{
    using (var hashGenerator = SHA256.Create())
    {
        var hash = hashGenerator.ComputeHash(Encoding.Default.GetBytes(password));
        return BitConverter.ToString(hash).Replace("-", "").ToLower();
    }

    return password;
}

void Exitprogram()
{
    Console.Clear();
    Console.Title = "ERP - Quit";

    Console.ForegroundColor = ConsoleColor.White;

    Console.CursorVisible = false;
    string goodbyeText = @"
         █████  ██    ██     ██████  ███████ ██    ██  ██████  ██ ██████  
        ██   ██ ██    ██     ██   ██ ██      ██    ██ ██    ██ ██ ██   ██ 
        ███████ ██    ██     ██████  █████   ██    ██ ██    ██ ██ ██████  
        ██   ██ ██    ██     ██   ██ ██       ██  ██  ██    ██ ██ ██   ██ 
        ██   ██  ██████      ██   ██ ███████   ████    ██████  ██ ██   ██ 
        ";
    string[] goodbyeScreen = goodbyeText.Split("\n");
    int goodbyeScreenHeight = Console.WindowHeight / 2 - 6;

    for (int i = 0; i < goodbyeScreen.Length; i++)
    {
        Console.CursorLeft = Console.WindowWidth / 2 - (goodbyeScreen[i].Length / 2 - 2);
        Console.CursorTop = goodbyeScreenHeight + i;
        Console.WriteLine(goodbyeScreen[i]);
    }

    Thread.Sleep(100);
    Environment.Exit(0);
}

