using System.Data;
using System.Security.Cryptography;
using System.Text;
using MySqlConnector;

string m_strMySQLConnectionString;
m_strMySQLConnectionString = "server=localhost;userid=root;password=root;database=db_TEST_FORMATIF;port=6033";

Clients_CSV();

void Clients_CSV()
{
    Console.Clear();

    using (var mysqlconnection = new MySqlConnection(m_strMySQLConnectionString))
    {
        mysqlconnection.Open();
        int added = 0;

        string filepath = @"C:\Users\pt50cuy\Downloads\eval3\msig-prog-eval3-training-erp1-data-small.csv";

        try
        {
            foreach (string line in File.ReadAllLines(filepath))
            {
                var columns = line.Split(";");
                string show_id = columns[0].ToLower();
                string type = columns[1].ToLower();
                string title = columns[2].ToLower();
                string director = columns[3].ToLower();
                string cast = columns[4].ToLower();
                string country = columns[5].ToLower();
                string date_added = columns[6].ToLower();
                string release_year = columns[7].ToLower();
                string duration = columns[8].ToLower();
                string listed_in = columns[9].ToLower();
                string description = columns[10].ToLower();

                string image = title.ToLower()
                    .Replace(' ', '_').Replace('?', '_').Replace(':', '_').Replace('\'', '_').Replace('|', '_').Replace('´', '_')
                    .Replace('(', '_').Replace(')', '_').Replace('"', '_').Replace('*', '_') + ".jpg";

                string checkSql = "Select Count(*) From movie where title = @title";
                using (MySqlCommand checkCmd = new MySqlCommand(checkSql, mysqlconnection))
                {
                    checkCmd.Parameters.AddWithValue("@title", title);


                    object result = checkCmd.ExecuteScalar();
                    if (result != null && int.Parse(result.ToString()) > 0)
                    {
                        Console.WriteLine($"Doublon, de {title}");
                        continue;
                    }
                }

                var stock = 1;

                if (!description.ToLower().Contains("kid") || !description.ToLower().Contains("kids"))
                {

                    string sql = @"
INSERT INTO movie (show_id, type, title, director, cast, country, date_added, release_year, duration, listed_in, description, image, stock)
VALUES
(@show_id, @type, @title, @director, @cast, @country, @date_added, @release_year, @duration, @listed_in, @description, @image, @stock)";

                    using (MySqlCommand cmd = mysqlconnection.CreateCommand())
                    {
                        cmd.Parameters.AddWithValue("@show_id", show_id);
                        cmd.Parameters.AddWithValue("@type", type);
                        cmd.Parameters.AddWithValue("@title", title);
                        cmd.Parameters.AddWithValue("@director", director);
                        cmd.Parameters.AddWithValue("@cast", cast);
                        cmd.Parameters.AddWithValue("@country", country);
                        cmd.Parameters.AddWithValue("@date_added", date_added);
                        cmd.Parameters.AddWithValue("@release_year", release_year);
                        cmd.Parameters.AddWithValue("@duration", duration);
                        cmd.Parameters.AddWithValue("@listed_in", listed_in);
                        cmd.Parameters.AddWithValue("@description", description);
                        cmd.Parameters.AddWithValue("@image", image);
                        cmd.Parameters.AddWithValue("@stock", stock);

                        cmd.CommandType = CommandType.Text;
                        cmd.CommandTimeout = 300;
                        cmd.CommandText = sql;

                        added = added + cmd.ExecuteNonQuery();
                        Console.WriteLine($"{show_id} {type} {title} {director} {cast} {country} {date_added} {release_year} {duration} {listed_in} {description}");
                    }
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

